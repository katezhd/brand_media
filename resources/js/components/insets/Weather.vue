<template>
    <div class="weather inset-height" v-if="is_weather" :style="{ 'background-image': 'url(/images/weather_icons/' + weather.today.icon + '.svg)' }">
        <div class="horoscope__overlay"></div>
        <div class="weather__data weather__today" :class="weather.today.class">
            <div class="weather__badge" @click="open = true">
                <svg>
                    <use xlink:href="#place"/>
                </svg>
                <span>{{ city }}</span>
                <svg>
                    <use xlink:href="#chevron"/>
                </svg>
            </div>
            <div class="weather__today-wrap">
                <div class="weather__temp">{{ weather.today.temp }}°</div>
                <img class="weather__svg" :src="'/images/weather_icons/' + weather.today.icon + '.svg'" alt="">
            </div>
        </div>
        <div class="weather__other">
            <div v-for="(item, index) in weather.other" :key="index" class="weather__data" :class="item.class">
                <div class="weather__info">
                    <span class="weather__date">{{ item.date }}</span>
                    <div class="weather__day">{{ item.weekDay }}</div>
                </div>
                <img class="weather__svg" :src="'/images/weather_icons/' + item.icon + '.svg'" alt="">
                <div class="weather__temp">{{ item.temp }}°</div>
            </div>
        </div>
        <transition name="fade">
            <Modal v-if="open" @close="open = false" @id="getWeather" :controller="modal_type"></Modal>
        </transition>
    </div>
    <div class="weather inset-height" v-if="!is_weather" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <span class="horoscope__name">Погода</span>
        <div class="inset-error">
            <span>К сожалению, данные сейчас недоступны</span>
            <svg>
                <use xlink:href="#cryEmoji"/>
            </svg>
        </div>
    </div>
</template>

<script>
    import Modal from '../modals/Modal'
    import service from '../../service'
    
    export default {
        components: {
            Modal
        },
        data() {
            return {
                open: false,
                city_id: 3,
                weather: {
                    today: {},
                    other: []
                },
                modal_type: 'weather_cities',
                city: null,
                is_weather: false
            }
        },
        mounted() {
            this.getWeather();
        },
        methods: {
            getWeather(city_id = false) {
                if(localStorage.getItem('city_id') && typeof localStorage.getItem('city_id') != undefined) {
                    this.city_id = localStorage.getItem('city_id');
                }

                if(city_id) {
                    localStorage.setItem('city_id', city_id);
                }

                this.weather =  {
                    today: {},
                    other: []
                },
                axios.get(`/api/v1/app/weather`, {
                    params: {
                        city_id: city_id ? city_id : this.city_id,
                    }
                }).then(({ data }) => {
                    this.city = data[0].city.name;
                    data.forEach(el => {
                        let dataItem = {
                            weekDay: el.day,
                            date: service.getHumanDate(el.day, true),
                            icon: el.name,
                            class: el.name,
                            temp: Math.ceil(Number(el.temp))
                        };
                        if(service.isToday(el.day)) {
                            dataItem.weekDay = service.getWeekDay(el.day, true);
                            this.weather.today = dataItem;
                        } else {
                            dataItem.weekDay = service.getWeekDay(el.day, false);
                            this.weather.other.push(dataItem)
                        }
                    });
                    if(this.weather.today && this.weather.other.length) {
                        this.is_weather = true;
                    }
                })
            }
        }
    }
</script>