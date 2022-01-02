<template>
    <div>
        <header class="header">
            <div class="container">
                <div class="burger-menu">
                    <input class="menu-trigger hidden" id="togglenav" type="checkbox"/>
                    <label class="burger-wrapper" for="togglenav">
                        <div class="hamburger"></div>
                    </label>
                </div>
                <div class="header__wrap">
                    <a class="logo" href="/">
                        <img src="/images/logo.svg">
                    </a>
                    <nav class="header__nav">
                        <div class="header__top">
                            <a href="/politika-konfidencialnosti">Конфиденциальность</a>
                            <a href="/kontakty">Контакты</a>
                        </div>
                        <ul class="header__list">
                            <li class="header__list-item">
                                <a href="/" class="header__link" :class="{ 'active': page == 'main' }">Главная</a>
                            </li>
                            <li v-for="category in categories" :key="category.id" class="header__list-item">
                                <a ref="link" :href='"/category/" + category.uri' class="header__link" :class="{ 'active': page == category.uri }"  :data-name='category.uri'>{{ category.name }}</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <notifications position="top right" classes="notification"/>
        <main>
            <div>
                <router-view v-slot="{ Component }">
                    <component :is="Component" @category="setNewsCategory"/>
                </router-view>
            </div>
        </main>
    </div>
</template>

<script>
    import Content from './rows/Content'

    export default {
        components: {
            Content
        },
        data() {
            return {
                categories: [],
                page: '',
            }
        },
        mounted() {
            this.getCategories();
        },
        updated() {
            this.$nextTick(function () {
                this.setActiveCategory();
            })
        },
        methods: {
            getCategories() {
                axios.get(`/api/v1/app/categories?page=1&status=visible`)
                .then(({ data }) => {
                    this.categories = data.data;
                });
            },
            setActiveCategory() {
                let path = window.location.pathname.split('/');

                if(path[1].indexOf('category') > -1) {
                    this.page = path[2];
                } else if (path[1].indexOf('news') == -1){
                    this.page = '';
                }
            },
            setNewsCategory(category) {
                this.page = category;
            }
        }
    }
</script>