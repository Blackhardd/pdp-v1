jQuery(function($){
    $(document).ready(function(){
        let store = {
            state: {
                isPricelistLoading: false,
                isCategoryActive: false,
                isSalonActive: false,
                isCartLoading: false,
                salons: [],
                categories: null,
                pricelist: [],
                activeCategory: false,
                hairLengths: [
                    {
                        title: 'от 5-15 см',
                        id: 0
                    },
                    {
                        title: 'от 15 - 25 см (выше плеч, каре, боб)',
                        id: 1
                    },
                    {
                        title: 'от 25 - 40 см (ниже плеч/выше лопаток)',
                        id: 2
                    },
                    {
                        title: 'от 40 - 60 см (ниже лопаток)',
                        id: 3
                    }
                ],
                cart: {
                    master_option: 0,
                    hair_length: 0,
                    salon: false,
                    items: [],
                    total: 0
                }
            },
            sendPostData: function(url, data){
                let response = fetch(url,{
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
            },
            fetchSalons(){
                fetch(`${pdpVueData.rest_url}/pdp/v1/salons/get_all`)
                    .then((response) => response.json())
                    .then((data) => {
                        this.state.salons = data
                        console.log(data)
                    })
            },
            fetchCategories(){
                fetch(`${pdpVueData.rest_url}/pdp/v1/services/get_categories`)
                    .then((response) => response.json())
                    .then((data) => {
                        this.state.categories = data
                    })
            },
            fetchPricelist(){
                if(this.state.cart.salon){
                    this.state.isPricelistLoading = true
                    fetch(`${pdpVueData.rest_url}/pdp/v1/services/${this.state.cart.salon}`)
                        .then((response) => response.json())
                        .then((data) => {
                            this.state.pricelist = data
                            this.state.isPricelistLoading = false
                            this.state.isCategoryActive = false
                            this.setCategoryFromURL()
                        })
                }
            },
            setActiveCategory(cat){
                this.state.isCategoryActive = true
                this.state.activeCategory = this.state.pricelist[cat]
            },
            setCurrentSalon(id){
                if(this.state.cart.salon != id){
                    this.state.cart.items = []
                    this.state.cart.total = 0
                }

                this.state.cart.salon = id

                this.state.isSalonActive = true

                this.updateCart()
                this.fetchPricelist()
            },
            setSalonFromUrl(){
                let salon_id = new URL(window.location.href).searchParams.get('salonId')
                if(salon_id){
                    this.setCurrentSalon(salon_id)
                }
            },
            setCategoryFromURL(){
                let category = new URL(window.location.href).searchParams.get('cat')
                if(category){
                    this.setActiveCategory(category)
                }
            },
            setHairLength(length){
                this.state.cart.hair_length = length
                this.getTotal()
            },
            setMasterType(value){
                this.state.cart.master_option = value ? 1 : 0
                this.getTotal()
            },
            fetchCart(){
                fetch(`${pdpVueData.rest_url}/pdp/v1/get_cart`)
                    .then((response) => response.json())
                    .then((data) => {
                        this.state.cart = data
                    })
            },
            updateCart(){
                this.sendPostData(`${pdpVueData.rest_url}/pdp/v1/update_cart/`, { cart: this.state.cart })
            },
            isInCart(service){
                if(this.state.cart.items.find(x => x.id === service.id)){
                    return true
                }
                else{
                    return false
                }
            },
            addToCart(service){
                if(!this.isInCart(service)){
                    this.state.cart.items.push(service)
                }
                else{
                    this.state.cart.items = this.state.cart.items.filter(t => t.id !== service.id)
                }
                this.getTotal()
            },
            setCartState(value){
                this.state.isCartLoading = value
            },
            getTotal(){
                let self = this
                this.state.cart.total = this.state.cart.items.reduce(function(prev, cur){
                    if(cur.master && cur.prices.length == 1){
                        return parseInt(prev) + parseInt(cur.prices[0][self.state.cart.master_option])
                    }
                    else if(!cur.master && cur.prices.length == 1){
                        return parseInt(prev) + parseInt(cur.prices[0][0])
                    }
                    else if(!cur.master && cur.prices.length == 4){
                        return parseInt(prev) + parseInt(cur.prices[self.state.cart.hair_length][0])
                    }
                    else if(cur.master && cur.prices.length == 4){
                        return parseInt(prev) + parseInt(cur.prices[self.state.cart.hair_length][self.state.cart.master_option])
                    }
                    else{
                        return parseInt(prev) + parseInt(cur.price)
                    }
                }, 0)

                this.updateCart()
            },
            isHairServiceInCart(){
                return this.state.cart.items.filter((item) => item.prices.length >= 4)
            }
        }

        Vue.component('pdp-select', {
            props: ['name', 'placeholder', 'options', 'selected'],
            data: function(){
                return{
                    selected: Vue.util.extend({}, this.selected)
                }
            },
            mounted(){
                let vm = this;
                $(this.$el).find('select').selectric().on('change', function(){
                    vm.$emit('changed', this.value)
                })
            },
            updated(){
                $(this.$el).find('select').selectric('init')
            },
            template: `
                <div class="selectric-wrap">
                    <select class="selectric_pdp" v-model="selected" :name="name">
                        <option value="" disabled>{{placeholder}}</option>
                        <option v-for="option of options" :key="option.id" :value="option.id" :disabled="option.pricelist == false">{{option.title}}</option>
                    </select>
                </div>
            `
        })

        let header = new Vue({
            el: '.main-header',
            data: {
                isSubMenuActive: false,
                isSalonsListActive: false,
                isSalonsListMobileActive: false,
                isCartActive: false,
                isMobileMenuActive: false,
                activeSubMenu: false,
                sharedState: store.state
            },
            methods: {
                addToCart(id){
                    store.addToCart(id)
                },
                updateTotal(){
                    store.updateTotal()
                },
                closeMenus(){
                    this.isCartActive = false
                    this.isMobileMenuActive = false
                    this.isSalonsListMobileActive = false

                    this.toggleDimmer()
                },
                togglePhonesList(){
                    if(this.isCartActive){
                        this.isCartActive = false
                    }
                    else if(this.isMobileMenuActive){
                        this.isMobileMenuActive = false
                    }

                    this.isSalonsListMobileActive = !this.isSalonsListMobileActive

                    this.toggleDimmer()
                },
                toggleMenu(){
                    if(this.isSalonsListMobileActive){
                        this.isSalonsListMobileActive = false
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
                toggleDimmer(){
                    if(this.isCartActive || this.isMobileMenuActive || this.isSalonsListMobileActive){
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
                        this.$refs.cart.style.left = this.$refs.cartToggler.getBoundingClientRect().left - 30 + 'px'
                        this.$refs.cart.style.right = 'unset';
                    }
                    else if(window.matchMedia("(min-width: 800px)").matches && window.matchMedia("(max-width: 1150px)").matches){
                        this.$refs.cart.style.left = 'unset'
                        this.$refs.cart.style.right = '30px'
                    }
                },
                setCartState(isLoading){
                    store.setCartState(isLoading)
                }
            },
            mounted(){
                window.addEventListener('resize', this.setCartPosition)

                this.setCartPosition()
            }
        })

        let service_categories = new Vue({
            el: '#service-categories',
            data: {
                isShowingWarning: false,
                sharedState: store.state
            },
            methods: {
                forceSelectSalon(){
                    if(!this.sharedState.isSalonActive){
                        this.isShowingWarning = true
                    }
                },
                setActiveCategory(cat){
                    store.setActiveCategory(cat)

                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#appointment-list").offset().top - 120
                    }, 1000);
                },
                setActiveSalon(id){
                    window.history.replaceState(null, null, '?salonId=' + id);
                    store.setCurrentSalon(id)
                    this.isShowingWarning = false
                }
            },
            mounted(){
                store.fetchSalons()
                store.setSalonFromUrl()
                store.fetchCategories()
            }
        })

        Vue.component('service-categories', {
            props: ['isLoading', 'isSalonActive', 'categories', 'pricelist'],
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
            methods: {
                stretchSlider(){
                    let offset = $(this.$el).offset().left
                    $(this.$el).width('calc(100vw - ' + offset + 'px)')
                }
            },
            mounted(){
                this.stretchSlider()
                $(this.$el).find('.service-categories').slick(this.slickOptions)
            },
            updated(){
                $(this.$el).find('.service-categories').slick('unslick')
                window.addEventListener("resize", this.stretchSlider)
                $(this.$el).find('.service-categories').slick(this.slickOptions)
            },
            template: `
                <div class="service-categories-wrap">
                    <div class="backdrop" :class="{ active: isLoading }"><div class="loader"><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div>
                    <div class="service-categories" v-if="isSalonActive">
                        <div v-for="(category, name, index) of pricelist" :key="category">
                            <div class="service-categories__category">
                                <div v-html="category.image"></div>
                                <div class="service-categories__title" @click="$emit('set-category', name)">
                                    {{category.name}}
                                    <svg width="25" height="16" fill="none"><path d="M24.7 8.7a1 1 0 000-1.4L18.35.92a1 1 0 10-1.41 1.41L22.59 8l-5.66 5.66a1 1 0 001.41 1.41l6.37-6.36zM0 9h24V7H0v2z" fill="#000"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-categories" v-else>
                        <div v-for="category of categories" :key="category.slug">
                            <div class="service-categories__category">
                                <div v-html="category.img"></div>
                                <div class="service-categories__title" @click="$emit('force-select-salon')">
                                    {{category.title}}
                                    <svg width="25" height="16" fill="none"><path d="M24.7 8.7a1 1 0 000-1.4L18.35.92a1 1 0 10-1.41 1.41L22.59 8l-5.66 5.66a1 1 0 001.41 1.41l6.37-6.36zM0 9h24V7H0v2z" fill="#000"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `
        })

        let service_list = new Vue({
            el: '#appointment-list',
            data(){
                return {
                    sharedState: store.state
                }
            },
            methods: {
                isInCart(id){
                    return store.isInCart(id)
                },
                addToCart(service){
                    store.addToCart(service)
                },
                changeMasterType(e){
                    store.setMasterType(e.target.checked)
                },
                updateTotal(){
                    store.updateTotal()
                },
                setCartState(isLoading){
                    store.setCartState(isLoading)
                }
            },
            mounted() {
                store.fetchCart()
            }
        });

        /**
         *  Price List Item Component
         */
        Vue.component('pricelist-item', {
            template: `
                <div class="pricelist-item">
                    <div class="pricelist-item__info">
                        <div class="pricelist-item__name">
                            {{data.name}}<span class="badge pro" v-if="data.pro"></span>
                        </div>

                        <div class="pricelist-item__price" v-if="data.master == true && data.prices.length == 1">{{data.prices[0][masterOption]}}<span class="uah"></span></div>
                        <div class="pricelist-item__price" v-else-if="data.master == false && data.prices.length == 1">{{data.prices[0][0]}}<span class="uah"></span></div>
                        <div class="pricelist-item__price" v-else-if="data.master == true && data.prices.length == 3 && hair_length <= 3">{{data.prices[hairLength][masterOption]}}<span class="uah"></span></div>
                        <div class="pricelist-item__price" v-else-if="data.master == false && data.prices.length == 3 && hair_length <= 3">{{data.prices[hairLength][0]}}<span class="uah"></span></div>
                        <div class="pricelist-item__price" v-else-if="data.master == true && data.prices.length == 4">{{data.prices[hairLength][masterOption]}}<span class="uah"></span></div>
                        <div class="pricelist-item__price" v-else-if="data.master == false && data.prices.length == 4">{{data.prices[hairLength][0]}}<span class="uah"></span></div>
                    </div>

                    <button class="pricelist-item__add-btn btn-icon" :data-added="isAdded" @click="$emit('add-to-cart', data)">
                        <span class="pricelist-item__icon"></span>
                    </button>
                </div>
            `,
            props: ['data', 'hairLength', 'masterOption', 'isAdded']
        });


        /**
         *  Hair Length Select Component
         */
        Vue.component('hair-length-select', {
            template: `
                <div class="selectric-wrap">
                    <select name="hair_length" class="selectric_pdp" :value="value">
                        <option value="" disabled>Выберите длину</option>
                        <option v-for="length of lengths":key="length.id" :value="length.id">{{length.title}}</option>
                    </select>
                </div>
            `,
            props: ['value'],
            data: function(){
                return {
                    lengths: [
                        {
                            title: 'от 5-15 см',
                            id: 0
                        },
                        {
                            title: 'от 15 - 25 см (выше плеч, каре, боб)',
                            id: 1
                        },
                        {
                            title: 'от 25 - 40 см (ниже плеч/выше лопаток)',
                            id: 2
                        },
                        {
                            title: 'от 40 - 60 см (ниже лопаток)',
                            id: 3
                        }
                    ]
                }
            },
            mounted(){
                let vm = this

                $(vm.$el).find('select').selectric('init').on('change', function(){
                    store.setHairLength(this.value)
                });
            }
        });


        /**
         *  Cart Component
         */
        Vue.component('cart', {
            template: `
                <div>
                    <div class="backdrop" :class="{ active: isLoading }"><div class="loader"><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div>
                    <form class="form cart-form cart__form" @submit.prevent="submitForm">
                        <div class="cart-form__header">
                            ваше бронирование
                        </div>
                
                        <div v-if="cartData.items.length">
                            <div class="cart-form__list">
                                <div v-for="(service, index) in cartData.items" :key="index">
                                    <button type="button" class="pricelist-item__add-btn btn-icon" :data-id="service.id" @click="$emit('add-to-cart', service)" data-added>
                                        <span class="pricelist-item__icon"></span>
                                    </button>
                                    {{service.name}}
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="alert mb_60px mt_50px">
                                <div class="alert__icon">!</div>
                                <div class="alert__content">Выберите услуги</div>
                            </div>
                        </div>
                        
                        <div class="cart-form__salon-wrap" v-if="cartData.salon">
                            <div class="cart-for__label">салон:</div>
                            <div class="cart-form__salon-title">{{ currentSalon }}</div>
                        </div>
                
                        <div class="cart-form__title">заполните форму</div>
                
                        <div class="form__row">
                            <div class="form__col_full">
                                <div class="inputWrap inputWrap_iconed">
                                    <div class="inputWrap__icon">
                                        <svg width="14" height="14" fill="none">
                                            <path d="M10.8 9.4C9.1 8.7 8.5 9 8.5 7.9v-.2h2.7c.4-.3-1-.8-1-4.5C10.2 1.3 9 0 7.1 0H7h-.1C5 0 3.8 1.3 3.8 3.2c0 3.7-1.4 4.2-1 4.5h2.6v.2c0 1.2-.5.8-2.2 1.5C1.4 10 .9 10.7.9 11V14h12.2v-2.9c0-.4-.5-1-2.3-1.7z" fill="#000"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="name" class="input input_text" placeholder="Как к вам обращаться?" v-model="name" required>
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
                                    <input type="tel" name="phone" class="input input_tel" placeholder="Номер телефона" v-model="phone" required>
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
                                    <input type="email" name="email" class="input input_email" placeholder="Электронная почта" v-model="email">
                                </div>
                            </div>
                        </div>
                
                        <div class="form__response active error" v-if="formErrors.length">
                            <ul>
                                <li v-for="(error, index) in formErrors" :key="index">{{ error }}</li>
                            </ul>
                        </div>
                
                        <div class="cart-form__footer">
                            <input type="submit" value="записаться" class="btn-default">
                
                            <div class="cart-form__total">
                                стоимость услуг
                                <div class="cart-form__total-price">
                                    <div class="cart-form__price">{{ cartData.total }}</div>
                                    <div class="cart-form__currency"><span class="uah"></span></div>
                                </div>
                            </div>
                        </div>
                
                        <input type="hidden" name="action" value="appointment">
                        <input type="hidden" name="salon" :value="cartData.salon">
                        <input type="hidden" name="cart" :value="JSON.stringify(cartData)">
                    </form>
                </div>
            `,
            props: ['cartData', 'salons', 'isLoading'],
            data: function(){
                return {
                    formErrors: [],
                    name: '',
                    phone: '',
                    email: ''
                }
            },
            computed: {
                currentSalon: function(){
                    if(this.salons){
                        let self = this
                        return self.salons.find((salon) => salon.id == self.cartData.salon).title
                    }
                }
            },
            methods: {
                submitForm(){
                    let isValid = true
                    this.formErrors = []

                    if(!this.name){
                        this.formErrors.push('Укажите имя')
                        isValid = false
                    }

                    if(!this.phone){
                        this.formErrors.push('Укажите номер телефона')
                        isValid = false
                    }

                    if(!this.cartData.items.length){
                        this.formErrors.push('Вы не выбрали услуги')
                        isValid = false
                    }

                    if(isValid){
                        let self = this;
                        let form_data = new FormData(event.target)
                        $.ajax({
                            method: 'POST',
                            url: pdpVueData.ajax_url,
                            processData: false,
                            contentType: false,
                            data: form_data,
                            beforeSend: function(){
                                self.$emit('cart-is-loading', true)
                            },
                            success: function(res){
                                self.$emit('cart-is-loading', false)
                                self.name = self.phone = self.email = ''
                            }
                        })
                    }
                },
                isHairServicesInCart(){
                    return this.cartData.items.filter((item) => item.prices.length > 1).length
                }
            },
            mounted(){
                store.fetchCart()
            }
        });
    });
});