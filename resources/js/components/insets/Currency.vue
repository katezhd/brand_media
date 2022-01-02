<template>
    <div class="currency inset-height" :style="{ 'background-image': 'url(/images/currency.svg)' }">
        <div class="horoscope__overlay"></div>
        <div class="currency__wrap">
            <span class="currency__badge">{{date}}</span>
        </div>
        <table v-if="currency.length">
            <tr>
                <th width="20%"></th>
                <th width="25%">покупка</th>
                <th width="25%">продажа</th>
            </tr>
            <tr v-for="(currencyItem, index) in currency" :key="index">
                <td class="currency__name">{{ currencyItem.name }}</td>
                <td>
                    <div class="currency__sum">
                        <span>{{ currencyItem.purchase }}</span>
                    </div>
                </td>
                <td>
                    <div class="currency__sum">
                        <span>{{ currencyItem.sale }}</span>
                    </div>
                </td>
            </tr>
        </table>
        <div v-if="!currency.length" class="inset-error">
            <span>К сожалению, данные сейчас недоступны</span>
            <svg>
                <use xlink:href="#cryEmoji"/>
            </svg>
        </div>
    </div>
</template>

<script>
    import service from '../../service'
    export default {
        data() {
            return {
                currency: [],
                date: null
            }
        },
        mounted() {
            this.getCurrency();
            const current = new Date();
            this.date = service.getNumberDate(current);
        },
        methods: {
            getCurrency() {
                axios.get(`/api/v1/app/currency`).then(({ data }) => {
                    data.map(function(item) {
                        item.purchase = Number(item.purchase).toFixed(2);
                        item.sale = Number(item.sale).toFixed(2);
                        return item;
                    });
                    this.currency.push(...data);
                })
            }
        }
    }
</script>
