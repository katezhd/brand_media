<template>
    <transition name="fade">
        <div class="modal opened">
            <div class="modal__content">
                <button class="modal__close" @click="hideModal">
                    <svg>
                        <use xlink:href="#close"/>
                    </svg>
                </button>
                <span class="modal__message">{{ text }}:</span>
                <ul class="modal__list" v-if="list">
                    <li class="modal__list-item" v-for="(item, index) in list" :key="index" @click="getData(item.id)">{{ item.name }}</li>
                </ul>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: 'modal',
        emits: ['close', 'id'],
        props: ['controller'],
        data() {
            return {
                text: null,
                list: null
            }
        },
        mounted() {
            if(this.$props.controller == 'horoscope_signs') {
                this.text = 'Выберите свой знак зодиака';
            } else {
                this.text = 'Выберите свой город'
            }
            this.getList();
        },
        methods: {
            hideModal() {
                let modal = document.querySelectorAll('.modal')[0];
                modal.classList.remove('opened');
                this.$emit('close', true);
            },
            getData(id) {
                this.$emit('id', id);
                this.hideModal();
            },
            getList() {
                axios.get(`/api/v1/app/${this.$props.controller}`).then(({ data }) => {
                    this.list = data;
                })
            }
        }
    }
</script>
