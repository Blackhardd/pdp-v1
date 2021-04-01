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
                activeCategory: false
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
                }
            },
            actions: {
                async fetchCart(ctx){
                    const res = await fetch(`${pdp_vue_data.rest_url}/pdp/v1/get_cart`)
                    const cart = await res.json()

                    ctx.commit('setCart', cart)
                },
                async addToCart(ctx, service){
                    ctx.commit('addToCart', service)

                    await fetch(`${pdp_vue_data.rest_url}/pdp/v1/update_cart/`, {
                        method: 'POST',
                        body: JSON.stringify({ cart: ctx.state.cart }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                },
                async setActiveSalon(ctx, salon){
                    ctx.commit('setActiveSalon', salon)
                    ctx.commit('clearCart')

                    ctx.dispatch('fetchPricelist', salon)
                },
                async setHairLength(ctx, length){
                    ctx.commit('setHairLength', length)

                    await fetch(`${pdp_vue_data.rest_url}/pdp/v1/update_cart/`, {
                        method: 'POST',
                        body: JSON.stringify({ cart: ctx.state.cart }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                },
                async setMasterOption(ctx, value){
                    ctx.commit('setMasterOption', value)

                    await fetch(`${pdp_vue_data.rest_url}/pdp/v1/update_cart/`, {
                        method: 'POST',
                        body: JSON.stringify({ cart: ctx.state.cart }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                },
                async fetchSalons(ctx){
                    const res = await fetch(`${pdp_vue_data.rest_url}/pdp/v1/salons/get_all/${pdp_vue_data.lang}`)
                    const salons = await res.json()

                    ctx.commit('setSalons', salons)
                },
                async fetchCategories(ctx){
                    const res = await fetch(`${pdp_vue_data.rest_url}/pdp/v1/services/get_categories`)
                    const categories = await res.json()

                    ctx.commit('setCategories', categories)
                },
                async fetchPricelist(ctx, salonId){
                    const res = await fetch(`${pdp_vue_data.rest_url}/pdp/v1/services/${salonId}`)
                    const pricelist = await res.json()

                    console.log(ctx.state.cart.salon)

                    ctx.commit('setPricelist', pricelist)
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
                            title: pdp_vue_lang.hair_length_1st,
                            id: 0
                        },
                        {
                            title: pdp_vue_lang.hair_length_2nd,
                            id: 1
                        },
                        {
                            title: pdp_vue_lang.hair_length_3rd,
                            id: 2
                        },
                        {
                            title: pdp_vue_lang.hair_length_4th,
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
                        <div v-for="(category, index) of categories" :key="index">
                            <div class="service-categories__category">
                                <div v-html="category.img"></div>
                                <div class="service-categories__title" @click="$emit('show-category', category.slug)">
                                    {{ category.title }}
                                    <svg width="25" height="16" fill="none"><path d="M24.7 8.7a1 1 0 000-1.4L18.35.92a1 1 0 10-1.41 1.41L22.59 8l-5.66 5.66a1 1 0 001.41 1.41l6.37-6.36zM0 9h24V7H0v2z" fill="#000"/></svg>
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
                        $(vm.$el).find('.service-categories').slick(this.slickOptions)
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
                return{
                    slickOptions: {
                        infinite: false,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        variableWidth: true,
                        autoplay: false,
                        swipeToSlide: true,
                        arrows: false,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 2,
                                    arrows: false
                                }
                            },
                            {
                                breakpoint: 550,
                                settings: {
                                    slidesToShow: 1,
                                    arrows: false
                                }
                            }
                        ]
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
                    if(pdp_vue_data.lang == 'ru'){
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
                <div>
                    <preloader :is-active="isLoading" />
                    <form class="form cart-form cart__form" @submit.prevent="submitForm">
                        <div class="cart-form__header">{{ pdp_vue_lang.your_booking }}</div>
                        
                        <div v-if="cart.items.length">
                            <div class="cart-form__list">
                                <div v-for="(service, index) in cart.items" :key="index">
                                    <button type="button" class="pricelist-item__add-btn btn-icon" @click="removeFromCart(service)" data-added>
                                        <span class="pricelist-item__icon"></span>
                                    </button>
                                    {{ service.name[pdp_vue_data.lang] }}
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="alert mb_60px mt_50px">
                                <div class="alert__icon">!</div>
                                <div class="alert__content">{{ pdp_vue_lang.select_service }}</div>
                            </div>
                        </div>
                                
                        <div class="cart-form__hair-length" v-show="isHairServiceInCart">
                            <hair-length-select />
                        </div>
                        
                        <div class="cart-form__title">{{ pdp_vue_lang.fill_the_form }}</div>
                        
                        <div class="form__row">
                            <div class="form__col_full">
                                <div class="inputWrap inputWrap_iconed">
                                    <div class="inputWrap__icon">
                                        <svg width="14" height="14" fill="none">
                                            <path d="M10.8 9.4C9.1 8.7 8.5 9 8.5 7.9v-.2h2.7c.4-.3-1-.8-1-4.5C10.2 1.3 9 0 7.1 0H7h-.1C5 0 3.8 1.3 3.8 3.2c0 3.7-1.4 4.2-1 4.5h2.6v.2c0 1.2-.5.8-2.2 1.5C1.4 10 .9 10.7.9 11V14h12.2v-2.9c0-.4-.5-1-2.3-1.7z" fill="#000"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="name" class="input input_text" :placeholder="pdp_vue_lang.how_call_you" v-model="name" required/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form__row">
                            <div class="form__col_full">
                                <div class="inputWrap inputWrap_iconed">
                                    <div class="inputWrap__icon">
                                        <svg width="14" height="14" fill="none">
                                            <path d="M13.7 11L11.5 9c-.4-.4-1.1-.4-1.6 0L9 10l-.3-.1C8 9.5 7 9 6 8 5 7 4.5 6 4.1 5.4L4 5.2l.7-.8.4-.3c.4-.5.4-1.2 0-1.6L3 .3C2.5 0 1.8 0 1.4.3L.8 1A3.5 3.5 0 000 2.8c-.2 2.3.8 4.5 3.8 7.4 4 4 7.3 3.8 7.4 3.8a3.7 3.7 0 001.8-.8l.7-.5c.4-.5.4-1.2 0-1.6z" fill="#000"/>
                                        </svg>
                                    </div>
                                    <input type="tel" name="phone" class="input input_tel" :placeholder="pdp_vue_lang.phone_number" v-model="phone" required/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form__row">
                            <div class="form__col_full">
                                <div class="inputWrap inputWrap_iconed">
                                    <div class="inputWrap__icon">
                                        <svg width="14" height="12" fill="none">
                                            <path d="M1.34 3.9A361.82 361.82 0 005 6.42a36.7 36.7 0 01.76.53c.1.08.24.17.4.26.16.1.31.16.45.21.14.05.27.07.4.07s.26-.02.4-.07.29-.12.45-.21A8.25 8.25 0 009 6.43l3.65-2.54c.38-.26.7-.59.96-.96.25-.38.38-.77.38-1.18 0-.34-.12-.64-.37-.88a1.2 1.2 0 00-.88-.37H1.25C.85.5.54.64.32.9.11 1.19 0 1.53 0 1.93c0 .33.14.69.43 1.07.29.38.6.68.91.9z" fill="#000"/>
                                            <path d="M13.22 4.73a162.38 162.38 0 00-4.61 3.2c-.19.13-.44.25-.74.38-.31.13-.6.19-.86.19H7c-.27 0-.56-.06-.87-.2-.3-.12-.55-.24-.74-.37l-.72-.5c-.7-.52-2-1.42-3.88-2.7-.3-.2-.56-.43-.79-.68v6.2c0 .34.12.64.37.88.24.25.54.37.88.37h11.5c.34 0 .64-.12.88-.37.25-.24.37-.54.37-.88v-6.2a4.3 4.3 0 01-.78.68z" fill="#000"/>
                                        </svg>
                                    </div>
                                    <input type="email" name="email" class="input input_email" :placeholder="pdp_vue_lang.email" v-model="email" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="form__response active error" v-if="formErrors.length && !isSubmitSuccess">
                            <ul>
                                <li v-for="(error, index) in formErrors" :key="index">{{ error }}</li>
                            </ul>
                        </div>
                        <div class="form__response active success" v-else-if="!formErrors.length && isSubmitSuccess">
                            <div v-html="submitResponse"></div>
                        </div>
                        
                        <div class="cart-form__footer">
                            <input type="submit" class="btn-default" :value="pdp_vue_lang.book_now" />
                        
                            <div class="cart-form__total">
                                {{ pdp_vue_lang.cost_of_services }}
                                <div class="cart-form__total-price">
                                    <div class="cart-form__price">{{ cartTotal }}</div>
                                    <div class="cart-form__currency"><span class="uah"></span></div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="action" value="booking">
                    </form>
                </div>
            `,
            data: function(){
                return {
                    isLoading: false,
                    isSubmitSuccess: false,
                    submitResponse: '',
                    formErrors: [],
                    name: '',
                    phone: '',
                    email: ''
                }
            },
            computed: {
                cart: function(){
                    return this.$store.getters.cart
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
                submitForm(){
                    let isValid = true
                    this.formErrors = []

                    if(!this.name){
                        this.formErrors.push(pdp_vue_lang.enter_a_name)
                        isValid = false
                    }

                    if(!this.phone){
                        this.formErrors.push(pdp_vue_lang.enter_a_phone)
                        isValid = false
                    }

                    if(!this.cart.items.length){
                        this.formErrors.push(pdp_vue_lang.no_services)
                        isValid = false
                    }

                    if(isValid){
                        let self = this;
                        let form_data = new FormData(event.target)
                        form_data.append('cart', JSON.stringify(this.cart))
                        form_data.append('total', this.cartTotal)
                        form_data.append('is_hair_services', this.isHairServiceInCart)

                        $.ajax({
                            method: 'POST',
                            url: pdp_vue_data.ajax_url,
                            processData: false,
                            contentType: false,
                            data: form_data,
                            beforeSend: function(){
                                self.isLoading = true
                            },
                            success: function(res){
                                self.isLoading = false
                                self.name = self.phone = self.email = ''
                                self.isSubmitSuccess = true
                                self.submitResponse = JSON.parse(res).message
                            }
                        })
                    }
                }
            }
        })


        /**
         *  Preloader Component
         */
        Vue.component('preloader', {
            template: `
                <div class="backdrop" :class="{ active: isActive }"><div class="loader"><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div>
            `,
            props: ['isActive']
        })


        /**
         *  Header App
         */
        new Vue({
            el: '#header-app',
            store: store,
            mounted(){
                this.fetchCart()
                this.setCartPosition()
                window.addEventListener('resize', this.setCartPosition)
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
                },
                setCartPosition(){
                    if(window.matchMedia("(min-width: 1150px)").matches) {
                        this.$refs.cart.style.left = Math.floor(this.$refs.cartToggler.getBoundingClientRect().left - 30) + 'px'
                        this.$refs.cart.style.right = 'unset';
                    }
                    else if(window.matchMedia("(min-width: 800px)").matches && window.matchMedia("(max-width: 1150px)").matches){
                        this.$refs.cart.style.left = 'unset'
                        this.$refs.cart.style.right = '30px'
                    }
                },
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
            mounted(){
                this.setActiveCategoryFromURI()
            },
            methods: {
                fetchSalons(){
                    return this.$store.dispatch('fetchSalons')
                },
                fetchCategories(){
                    return this.$store.dispatch('fetchCategories')
                },
                setActiveCategory(cat){
                    if(cat == 'sertifikati'){
                        window.open(pdp_vue_data.gift_cards_url,'_blank')
                    }
                    else{
                        this.$store.dispatch('setActiveCategory', cat)
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#appointment-list").offset().top - 140
                        }, 1000)
                    }
                },
                setActiveCategoryFromURI(){
                    let uri = window.location.search.substring(1)
                    let params = new URLSearchParams(uri)

                    if(params.get('cat')){
                        this.$store.dispatch('setActiveCategory', params.get('cat'))
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
                    return (pdp_vue_data.lang == 'ru') ? pdp_vue_data.lang : 'ua';
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