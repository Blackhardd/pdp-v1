jQuery(function($){
    $(document).ready(function(){
        let store = new Vuex.Store({
            state: {
                cart: {
                    hair_length: 0,
                    master_option: 0,
                    salon: false,
                    items: []
                },
                salons: [],
                categories: [],
                pricelist: [],
                activeCategory: false,
                isFirstLoad: true
            },
            getters: {
                cart: function(state){
                    return state.cart
                },
                isServiceInCart(state){
                    return function(service){
                        if(state.cart.items.find(item => item.id === service.id)){
                            return true
                        }

                        return false
                    }
                },
                cartTotal: function(state){
                    return state.cart.items.reduce(function(prev, cur){
                        if(cur.master && cur.prices.length == 1){
                            return parseInt(prev) + parseInt(cur.prices[0][state.cart.master_option])
                        }
                        else if(!cur.master && cur.prices.length == 1){
                            return parseInt(prev) + parseInt(cur.prices[0][0])
                        }
                        else if(cur.master && cur.prices.length == 3){
                            return (state.cart.hair_length < 3) ? parseInt(prev) + parseInt(cur.prices[state.cart.hair_length][state.cart.master_option]) : parseInt(prev) + parseInt(cur.prices[2][state.cart.master_option]);
                        }
                        else if(!cur.master && cur.prices.length == 3){
                            return (state.cart.hair_length < 3) ? parseInt(prev) + parseInt(cur.prices[state.cart.hair_length][0]) : parseInt(prev) + parseInt(cur.prices[2][0]);
                        }
                        else if(!cur.master && cur.prices.length == 4){
                            return parseInt(prev) + parseInt(cur.prices[state.cart.hair_length][0])
                        }
                        else if(cur.master && cur.prices.length == 4){
                            return parseInt(prev) + parseInt(cur.prices[state.cart.hair_length][state.cart.master_option])
                        }

                        return parseInt(prev) + parseInt(cur.price)
                    }, 0)
                },
                cartItems: function(state){
                    return state.cart.items.length
                },
                hairLength: function(state){
                    return state.cart.hair_length
                },
                masterOption: function(state){
                    return state.cart.master_option
                },
                salons: function(state){
                    return state.salons
                },
                activeSalon: function(state){
                    return state.cart.salon
                },
                categories: function(state){
                    return state.categories
                },
                pricelist: function(state){
                    return state.pricelist
                },
                activeCategory: function(state){
                    return state.activeCategory
                }
            },
            mutations: {
                setCart(state, data){
                    state.cart = data
                },
                setActiveSalon(state, salon){
                    state.cart.salon = salon
                },
                setHairLength(state, length){
                    state.cart.hair_length = length
                },
                setMasterOption(state, option){
                    state.cart.master_option = option
                },
                addToCart(state, service){
                    if(state.cart.items.find(item => item.id === service.id)){
                        state.cart.items = state.cart.items.filter(item => item.id != service.id)
                    }
                    else{
                        state.cart.items.push(service)
                    }
                },
                clearCart(state){
                    state.cart.items = []
                },
                setSalons(state, data){
                    state.salons = data
                },
                setCategories(state, data){
                    state.categories = data
                },
                setPricelist(state, data){
                    state.pricelist = data
                },
                setActiveCategory(state, category){
                    state.activeCategory = category
                },
                setFirstLoad(state, data){
                    state.isFirstLoad = data
                }
            },
            actions: {
                async fetchCart(ctx){
                    let cart = JSON.parse(window.sessionStorage.getItem('cart'))

                    if(cart !== null){
                        ctx.commit('setCart', cart)
                    }
                },
                async addToCart(ctx, service){
                    ctx.commit('addToCart', service)
                    window.sessionStorage.setItem('cart', JSON.stringify(ctx.state.cart))
                },
                async setActiveSalon(ctx, salon){
                    ctx.commit('setActiveSalon', salon)

                    if(salon != ctx.state.cart.salon){
                        ctx.commit('clearCart')
                    }

                    ctx.dispatch('fetchPricelist', salon)
                },
                async setHairLength(ctx, length){
                    ctx.commit('setHairLength', length)

                    await fetch(`${pdp_components_data.rest_url}/pdp/v1/update_cart/`, {
                        method: 'POST',
                        body: JSON.stringify({ cart: ctx.state.cart }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                },
                async setMasterOption(ctx, value){
                    ctx.commit('setMasterOption', value)

                    await fetch(`${pdp_components_data.rest_url}/pdp/v1/update_cart/`, {
                        method: 'POST',
                        body: JSON.stringify({ cart: ctx.state.cart }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                },
                async fetchSalons(ctx){
                    const res = await fetch(`${pdp_components_data.rest_url}/pdp/v1/salons/get_all/${pdp_components_data.lang}`)
                    const salons = await res.json()

                    ctx.commit('setSalons', salons)
                },
                async fetchCategories(ctx){
                    const res = await fetch(`${pdp_components_data.rest_url}/pdp/v1/services/get_categories`)
                    const categories = await res.json()

                    ctx.commit('setCategories', categories)
                },
                async fetchPricelist(ctx, salonId){
                    const res = await fetch(`${pdp_components_data.rest_url}/pdp/v1/services/${salonId}`)
                    const pricelist = await res.json()

                    ctx.commit('setPricelist', pricelist)

                    if(ctx.state.isFirstLoad){
                        ctx.dispatch('setDefaultCategory')
                        ctx.commit('setFirstLoad', false)
                    }
                },
                setDefaultCategory(ctx){
                    let uri = window.location.search.substring(1)
                    let params = new URLSearchParams(uri)

                    if(params.get('cat')){
                        ctx.commit('setActiveCategory', params.get('cat'))
                    }
                    else{
                        ctx.commit('setActiveCategory', 'vse-uslugi-dlya-muzhchin');
                    }
                },
                setActiveCategory(ctx, category){
                    ctx.commit('setActiveCategory', category)
                }
            }
        })


        /**
         *  Vue Components
         */


        /**
         *  Salon Select Component
         */
        Vue.component('salon-select', {
            template: `
                <div class="selectric-wrap">
                    <select name="salon" class="selectric_pdp" :value="activeSalon">
                        <option
                            v-for="salon of salons"
                            :key="salon.id"
                            :value="salon.id"
                            :disabled="!salon.pricelist"
                        >
                            {{ salon.title }}
                        </option>
                    </select>
                </div>
            `,
            mounted(){
                this.fetchSalons()
            },
            methods: {
                fetchSalons(){
                    let vm = this
                    vm.$store.dispatch('fetchSalons').then(() => {
                        let select = $(vm.$el).find('select').selectric()

                        let uri = window.location.search.substring(1);
                        let params = new URLSearchParams(uri);

                        if(params.get('salonId')){
                            vm.setSalonOption(params.get('salonId'))
                        }
                        else if(vm.activeSalon){
                            vm.setSalonOption(vm.activeSalon)
                        }
                        else{
                            vm.setSalonOption(vm.salons[0].id)
                        }

                        if(/android|ip(hone|od|ad)/i.test(navigator.userAgent)){
                            select.on('change', function(){
                                vm.$store.dispatch('setActiveSalon', $(this).val())
                            })
                        }
                        else{
                            select.on('selectric-change', function(event, element, selectric){
                                vm.$store.dispatch('setActiveSalon', element.value)
                            })
                        }
                    })
                },
                setSalonOption(value){
                    if(value){
                        $(this.$el).find('select').val(value).selectric('refresh')
                        this.$store.dispatch('setActiveSalon', value)
                    }
                }
            },
            computed: {
                salons: function(){
                    return this.$store.getters.salons
                },
                activeSalon: function(){
                    return this.$store.getters.activeSalon
                }
            }
        })


        /**
         *  Hair Length Select Component
         */
        Vue.component('hair-length-select', {
            template: `
                <div class="selectric-wrap">
                    <select name="hair_length" class="selectric_pdp" :value="length">
                        <option
                            v-for="length of lengths"
                            :key="length.id"
                            :value="length.id"
                        >
                            {{ length.title }}
                        </option>
                    </select>
                </div>
            `,
            mounted(){
                let vm = this
                let select = $(vm.$el).find('select').selectric('init')

                if(/android|ip(hone|od|ad)/i.test(navigator.userAgent)){
                    select.on('change', function(){
                        vm.$store.dispatch('setHairLength', $(this).val())
                    })
                }
                else{
                    select.on('selectric-change', function(event, element, selectric){
                        vm.$store.dispatch('setHairLength', element.value)
                    })
                }
            },
            data: function(){
                return {
                    lengths: [
                        {
                            title: pdp_components_i18n.hair_length_1st,
                            id: 0
                        },
                        {
                            title: pdp_components_i18n.hair_length_2nd,
                            id: 1
                        },
                        {
                            title: pdp_components_i18n.hair_length_3rd,
                            id: 2
                        },
                        {
                            title: pdp_components_i18n.hair_length_4th,
                            id: 3
                        }
                    ]
                }
            },
            computed: {
                length: function(){
                    return this.$store.getters.hairLength
                }
            },
            watch: {
                length: function(value){
                    $(this.$el).find('select').val(value).selectric('refresh')
                }
            }
        })


        /**
         *  Service Categories
         */
        Vue.component('service-categories', {
            template: `
                <div class="service-categories-wrap">
                    <div class="service-categories">
                        <div class="service-category" v-for="(category, index) of categories" :key="index">
                            <div class="service-category__inner" :data-category="category.slug">
                                <div v-html="category.img"></div>
                                <div class="service-category__title">
                                    {{ category.name[(pdp_components_data.lang == 'ru') ? pdp_components_data.lang : 'ua'] }}
                                    <svg width="25" height="16" fill="none"><path d="M24.7 8.7a1 1 0 000-1.4L18.35.92a1 1 0 10-1.41 1.41L22.59 8l-5.66 5.66a1 1 0 001.41 1.41l6.37-6.36zM0 9h24V7H0v2z" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `,
            mounted(){
                this.fetchCategories()
            },
            methods: {
                fetchCategories(){
                    let vm = this
                    this.$store.dispatch('fetchCategories').then(() => {
                        new Glider($(vm.$el).find('.service-categories')[0], vm.gliderOptions)
                        let $categories = $(vm.$el).find('.service-category__inner')
                        $categories.on('mousedown', function(e){
                            $categories.on('mouseup mousemove', function handler(e){
                                if(e.type === 'mouseup'){
                                    vm.$emit('show-category', $(this).data('category'))
                                }
                                $categories.off('mouseup mousemove', handler);
                            })
                        })
                        vm.stretchSlider()
                        window.addEventListener('resize', vm.stretchSlider)
                    })
                },
                stretchSlider(){
                    let offset = $(this.$el).offset().left
                    $(this.$el).width('calc(100vw - ' + offset + 'px)')
                }
            },
            data: function(){
                return {
                    gliderOptions: {
                        slidesToShow: 'auto',
                        slidesToScroll: 'auto',
                        itemWidth: 320,
                        exactWidth: true,
                        draggable: true,
                        dragVelocity: 1
                    }
                }
            },
            computed: {
                categories: function(){
                    return this.$store.getters.categories
                }
            }
        })


        /**
         *  Price List Item
         */
        Vue.component('pricelist-item', {
            template: `
                <div class="pricelist-item">
                    <div class="pricelist-item__info">
                        <div class="pricelist-item__name">
                            {{name}}<span class="badge pro" v-if="data.pro"></span>
                        </div>
    
                        <div class="pricelist-item__price">{{price}}<span class="uah"></span></div>
                    </div>
    
                    <button class="pricelist-item__add-btn btn-icon"
                        @click="addToCart(data)"
                        :data-added="isInCart(data)"
                    >
                        <span class="pricelist-item__icon"></span>
                    </button>
                </div>
                `,
            props: ['data'],
            methods: {
                addToCart(service){
                    this.$store.dispatch('addToCart', service)
                }
            },
            computed: {
                isInCart: function(){
                    return this.$store.getters.isServiceInCart
                },
                hair_length: function(){
                    return this.$store.getters.hairLength
                },
                master_option: function(){
                    return this.$store.getters.masterOption
                },
                name: function(){
                    if(pdp_components_data.lang == 'ru'){
                        return this.data.name.ru
                    }

                    return this.data.name.ua
                },
                price: function(){
                    let service = this.data

                    if(service.prices.length == 1){
                        if(service.master){
                            return service.prices[0][this.master_option]
                        }

                        return service.prices[0][0]
                    }
                    else if(service.prices.length == 3){
                        let h_length = this.hair_length < 3 ? this.hair_length : 2

                        if(service.master){
                            return service.prices[h_length][this.master_option]
                        }

                        return service.prices[h_length][0]
                    }
                    else if(service.prices.length == 4){
                        if(service.master){
                            return service.prices[this.hair_length][this.master_option]
                        }

                        return service.prices[this.hair_length][0]
                    }
                }
            }
        })


        /**
         *  Cart Component
         */
        Vue.component('cart', {
            template: `
                <form class="cart form" :class="{ loading: isLoading }" @submit.prevent="submitForm">
                    <div class="cart__header">{{ pdp_components_i18n.your_booking }}</div>
                        
                    <div v-if="cart.items.length">
                        <div class="cart__items-list">
                            <div v-for="(service, index) in cart.items" :key="index">
                                <button type="button" class="pricelist-item__add-btn btn-icon" @click="removeFromCart(service)" data-added><span class="pricelist-item__icon"></span></button>
                                {{ service.name[(pdp_components_data.lang == 'ru') ? 'ru' : 'ua'] }}
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="alert mb_60px mt_50px">
                            <div class="alert__icon">!</div>
                            <div class="alert__content">{{ pdp_components_i18n.select_service }}</div>
                        </div>
                    </div>
                                
                    <div class="cart__hair-length" v-show="isHairServiceInCart">
                        <hair-length-select />
                    </div>
                        
                    <div class="cart__title">{{ pdp_components_i18n.fill_the_form }}</div>
                        
                    <div class="form-row">
                        <div class="form-col">
                            <div class="input input--name" :class="{ error: fields.name.isInvalid, 'error-tooltip': fields.name.isTooltipVisible }">
                                <div class="input__errors">{{ fields.name.error }}</div>
                                <div class="input__wrap">
                                    <input type="text" name="name" required :placeholder="pdp_components_i18n.how_call_you" v-model="fields.name.value" @input="fields.name.isInvalid = false" />
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M10.834 9.381c-1.756-.633-2.318-.314-2.318-1.458 0-.054.004-.157.01-.262h.086c1.2.088 2.357.171 2.614-.009.411-.287-1.012-.73-1.012-4.443C10.214 1.332 8.978 0 7.101 0l-.048.001H7.04L7.02 0h-.061l-.013.001L6.9 0C5.022 0 3.785 1.332 3.785 3.209c0 3.714-1.422 4.156-1.011 4.443.257.18 1.413.097 2.614.01h.086c.006.104.01.207.01.261 0 1.144-.562.825-2.318 1.458-1.762.636-2.27 1.283-2.27 1.725V14h12.207v-2.894c0-.442-.508-1.09-2.27-1.725z" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="form-row">
                        <div class="form-col">
                            <div class="input input--phone" :class="{ error: fields.phone.isInvalid, 'error-tooltip': fields.phone.isTooltipVisible }">
                                <div class="input__errors">{{ fields.phone.error }}</div>
                                <div class="input__wrap">
                                    <input type="tel" name="phone" required :placeholder="pdp_components_i18n.phone_number" v-model="fields.phone.value" @input="fields.phone.isInvalid = false" />
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M13.69 11.06L11.52 8.9a1.13 1.13 0 00-1.59.03l-1.08 1.1a10.84 10.84 0 01-2.83-2.01c-1-1-1.53-1.95-1.9-2.64l-.13-.2.74-.74.35-.36c.45-.44.46-1.16.03-1.59L2.95.33a1.13 1.13 0 00-1.59.03l-.6.61.01.02a3.52 3.52 0 00-.73 1.78c-.28 2.37.8 4.53 3.74 7.47 4.05 4.05 7.32 3.75 7.46 3.73a3.65 3.65 0 001.79-.72h.01l.62-.6c.44-.44.46-1.16.03-1.59z" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="form-row">
                        <div class="form-col">
                            <div class="input input--email" :class="{ error: fields.email.isInvalid, 'error-tooltip': fields.email.isTooltipVisible }">
                                <div class="input__errors">{{ fields.email.error }}</div>
                                <div class="input__wrap">
                                    <input type="email" name="email" :placeholder="pdp_components_i18n.email" v-model="fields.email.value" @input="fields.email.isInvalid = false" />
                                    <svg width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M1.34 3.9A361.82 361.82 0 005 6.42a36.7 36.7 0 01.76.53c.1.08.24.17.4.26.16.1.31.16.45.21.14.05.27.07.4.07s.26-.02.4-.07.29-.12.45-.21A8.25 8.25 0 009 6.43l3.65-2.54c.38-.26.7-.59.96-.96.25-.38.38-.77.38-1.18 0-.34-.12-.64-.37-.88a1.2 1.2 0 00-.88-.37H1.25C.85.5.54.64.32.9.11 1.19 0 1.53 0 1.93c0 .33.14.69.43 1.07.29.38.6.68.91.9z" /><path d="M13.22 4.73a162.38 162.38 0 00-4.61 3.2c-.19.13-.44.25-.74.38-.31.13-.6.19-.86.19H7c-.27 0-.56-.06-.87-.2-.3-.12-.55-.24-.74-.37l-.72-.5c-.7-.52-2-1.42-3.88-2.7-.3-.2-.56-.43-.79-.68v6.2c0 .34.12.64.37.88.24.25.54.37.88.37h11.5c.34 0 .64-.12.88-.37.25-.24.37-.54.37-.88v-6.2a4.3 4.3 0 01-.78.68z" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="form__response active success" v-if="isSubmitSuccess">
                        <div v-html="submitResponse"></div>
                    </div>
                        
                    <div class="cart__footer">
                        <input type="submit" class="btn-default" :value="pdp_components_i18n.book_now" :disabled="isLoading || isCartEmpty" />
                        
                        <div class="cart__total">
                            {{ pdp_components_i18n.cost_of_services }}
                            <div class="cart__total-price">
                                <div class="cart__price">{{ cartTotal }}</div>
                                <div class="cart__currency"><span class="uah"></span></div>
                            </div>
                        </div>
                    </div>
                        
                    <input type="hidden" name="action" value="booking">
                </form>
            `,
            data: function(){
                return {
                    isLoading: false,
                    isFormValid: true,
                    isSubmitSuccess: false,
                    submitResponse: '',
                    fields: {
                        name: {
                            value: '',
                            error: '',
                            isInvalid: false,
                            isTooltipVisible: false
                        },
                        phone: {
                            value: '',
                            error: '',
                            isInvalid: false,
                            isTooltipVisible: false
                        },
                        email: {
                            value: '',
                            error: '',
                            isInvalid: false,
                            isTooltipVisible: false
                        }
                    }
                }
            },
            computed: {
                cart: function(){
                    return this.$store.getters.cart
                },
                isCartEmpty: function(){
                    return (this.cart.items.length) ? false : true
                },
                isHairServiceInCart: function(){
                    let hair_services = this.cart.items.filter((item) => item.prices.length >= 3)
                    if(hair_services.length){
                        return true
                    }

                    return false
                },
                cartTotal: function(){
                    return this.$store.getters.cartTotal
                }
            },
            methods: {
                removeFromCart(service){
                    this.$store.dispatch('addToCart', service)
                },
                validateForm(){
                    this.isFormValid = true

                    this.validateCart()

                    this.validateName()
                    this.validatePhone()
                    this.validateEmail()
                },
                validateCart(){
                    this.isFormValid = (this.cart.items.length) ? true : false
                },
                validateName(){
                    let field = this.fields.name

                    if(field.value.length < 3){
                        field.error = pdp_components_i18n.name_shorter;
                        field.isInvalid = true
                        field.isTooltipVisible = true

                        setTimeout(function(){
                            field.isTooltipVisible = false
                        }, 2000)

                        this.isFormValid = false
                    }
                    else if(field.value.length > 24){
                        field.error = pdp_components_i18n.name_longer;
                        field.isInvalid = true
                        field.isTooltipVisible = true

                        setTimeout(function(){
                            field.isTooltipVisible = false
                        }, 2000)

                        this.isFormValid = false
                    }
                },
                validatePhone(){
                    let re = /^\+?3?8?(0\d{9})$/
                    let field = this.fields.phone

                    if(!re.test(field.value)){
                        field.error = pdp_components_i18n.wrong_format;
                        field.isInvalid = true
                        field.isTooltipVisible = true

                        setTimeout(function(){
                            field.isTooltipVisible = false
                        }, 2000)

                        this.isFormValid = false
                    }
                },
                validateEmail(){
                    let re = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/
                    let field = this.fields.email

                    if(field.value && !re.test(field.value)){
                        field.error = pdp_components_i18n.wrong_format;
                        field.isInvalid = true
                        field.isTooltipVisible = true

                        setTimeout(function(){
                            field.isTooltipVisible = false
                        }, 2000)

                        this.isFormValid = false
                    }
                },
                submitForm(){
                    this.validateForm()

                    if(this.isFormValid){
                        let ctx = this
                        let form_data = new FormData(event.target)

                        form_data.append('cart', JSON.stringify(ctx.cart))
                        form_data.append('total', ctx.cartTotal)
                        form_data.append('is_hair_services', ctx.isHairServiceInCart)

                        $.ajax({
                            method: 'POST',
                            url: pdp_components_data.ajax_url,
                            processData: false,
                            contentType: false,
                            data: form_data,
                            beforeSend: function(){
                                ctx.isLoading = true
                            },
                            success: function(res){
                                ctx.isLoading = false
                                ctx.fields.name = ctx.fields.phone = ctx.fields.email = {
                                    value: '',
                                    error: '',
                                    isInvalid: false,
                                    isTooltipVisible: false
                                }
                                ctx.isSubmitSuccess = true
                                ctx.submitResponse = JSON.parse(res).message
                            }
                        })
                    }
                }
            }
        })


        /**
         *  Header App
         */
        new Vue({
            el: '#header-app',
            store: store,
            mounted(){
                this.fetchCart()
            },
            methods: {
                fetchCart(){
                    return this.$store.dispatch('fetchCart')
                },
                closeMenus(){
                    this.isCartActive = false
                    this.isMobileMenuActive = false
                    this.isMobileSalonsListActive = false

                    this.toggleDimmer()
                },
                togglePhonesList(){
                    if(this.isCartActive){
                        this.isCartActive = false
                    }
                    else if(this.isMobileMenuActive){
                        this.isMobileMenuActive = false
                    }

                    this.isMobileSalonsListActive = !this.isMobileSalonsListActive

                    this.toggleDimmer()
                },
                toggleMenu(){
                    if(this.isMobileSalonsListActive){
                        this.isMobileSalonsListActive = false
                    }

                    if(!this.isCartActive && !this.isMobileMenuActive){
                        this.isMobileMenuActive = true
                    }
                    else if(!this.isCartActive && this.isMobileMenuActive){
                        this.isMobileMenuActive = false
                    }
                    else if(this.isCartActive && !this.isMobileMenuActive){
                        this.isCartActive = false
                    }

                    this.toggleDimmer()
                },
                toggleMobileCart(){
                    this.isMobileMenuActive = false
                    this.isMobileSalonsListActive = false
                    this.isCartActive = !this.isCartActive

                    this.toggleDimmer()
                },
                toggleDimmer(){
                    if(this.isCartActive || this.isMobileMenuActive || this.isMobileSalonsListActive){
                        document.querySelector('body').style.overflow = 'hidden';
                        document.querySelector('.dimmer').classList.add('active');
                    }
                    else{
                        document.querySelector('body').style.overflow = 'auto';
                        document.querySelector('.dimmer').classList.remove('active');
                    }
                },
                showSubMenu(id){
                    if(id == this.activeSubMenu){
                        this.activeSubMenu = false
                    }
                    else{
                        this.activeSubMenu = id
                    }
                }
            },
            data: {
                isSubMenuActive: false,
                isCartActive: false,
                isMobileMenuActive: false,
                isMobileSalonsListActive: false,
                activeSubMenu: false
            },
            computed: {
                cartItems: function(){
                    return this.$store.getters.cartItems
                }
            }
        })


        /**
         *  Appointment App
         */
        new Vue({
            el: '#appointment-app',
            store: store,
            methods: {
                fetchSalons(){
                    return this.$store.dispatch('fetchSalons')
                },
                fetchCategories(){
                    return this.$store.dispatch('fetchCategories')
                },
                setActiveCategory(cat){
                    if(cat == 'sertifikati'){
                        window.open(pdp_components_data.gift_cards_url,'_blank')
                    }
                    else{
                        this.$store.dispatch('setActiveCategory', cat)
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#appointment-list").offset().top - 140
                        }, 1000)
                    }
                },
                setMasterOption($event){
                    this.$store.dispatch('setMasterOption', $event.target.checked ? 1 : 0)
                }
            },
            data: {
                isPricelistLoading: false
            },
            computed: {
                lang: function(){
                    return (pdp_components_data.lang == 'ru') ? pdp_components_data.lang : 'ua';
                },
                pricelist: function(){
                    return this.$store.getters.pricelist
                },
                activeCategory: function(){
                    return this.$store.getters.activeCategory
                },
                activeCategoryServices: function(){
                    return this.pricelist[this.activeCategory]
                },
                masterOption: function(){
                    return this.$store.getters.masterOption
                }
            }
        })
    })
});