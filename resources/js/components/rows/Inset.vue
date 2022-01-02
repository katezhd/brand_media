<template>
  <div>
    <VideoSlider v-if="inset.type == 'videos'"></VideoSlider>
    
    <div class="category-block__wrap" v-else-if="inset.type == 'categories'">
        <CategorySlider :category="inset" :category_name="inset.category_name"></CategorySlider>
    </div>
    <div class="row break" v-else-if="inset.type == 'custom'">
        <Weather v-if="inset.left.type == 'weather'"></Weather>
        <Quote v-if="inset.left.type == 'quote'" :content="inset.left"></Quote>
        <Joke v-if="inset.left.type == 'joke'" :content="inset.left"></Joke>
        <Horoscope v-if="inset.left.type == 'horoscope'"></Horoscope>
        <Video v-if="inset.left.type == 'video'" :content="inset.left"></Video>
        <Currency v-if="inset.left.type == 'currency'"></Currency>

        <Weather v-if="inset.right.type == 'weather'"></Weather>
        <Quote v-if="inset.right.type == 'quote'" :content="inset.right"></Quote>
        <Joke v-if="inset.right.type == 'joke'" :content="inset.right"></Joke>
        <Horoscope v-if="inset.right.type == 'horoscope'"></Horoscope>
        <Video v-if="inset.right.type == 'video'" :content="inset.right"></Video>
        <Currency v-if="inset.right.type == 'currency'"></Currency>
    </div>
  </div>
</template>

<script>
  import Quote from '../insets/Quote'
  import Weather from '../insets/Weather'
  import Joke from '../insets/Joke'
  import Horoscope from '../insets/Horoscope'
  import Video from '../insets/Video'
  import Currency from '../insets/Currency'
  import VideoSlider from '../sliders/VideoSlider'
  import CategorySlider from '../sliders/CategorySlider'

  export default {
    components: {
      Quote,
      Weather,
      Joke,
      Horoscope,
      Video,
      Currency,
      VideoSlider,
      CategorySlider
    },
    props: ['page'],
    data() {
      return {
        inset: [],
      }
    },
    mounted() {
      this.getInset();
    },
    methods: {
      getInset() {
        let page = this.$props.page,
            total = Number(localStorage.getItem('insets')),
            multiplier = Math.floor(page / total);

        if(page > total) {
          if(total * multiplier != page) {
            page = page - (total * multiplier);
          } else {
            page = total;
          }
        }
      
        axios.get(`/api/v1/app/insets`, {
                params: {
                    status: 'visible',
                    page: page,
                    sort: 'position|asc'
                }
        }).then(({ data }) => {
            localStorage.setItem('insets', data.total);

            if(data.data[0]) {
              data = data.data[0];

              let inset = {
                  type: data.type == 'random' ? 'custom' : data.type,
                  position: data.position,
                  id: data.id,
                  left: {
                    type: ''
                  },
                  right: {
                    type: ''
                  }
              };
              if(data.type == 'custom' ) {
                data.left ? inset.left = data.left : inset.left.type = data.data.left_id;
                data.right ? inset.right = data.right : inset.right.type = data.data.right_id;
              } else if(data.type == 'categories'){
                inset['category_name'] = data.category.name;
                inset['category_uri'] = data.category.uri;
              } else if(data.type == 'random') {
                data.left.id ? inset.left = data.left : inset.left.type = data.left;
                data.right.id ? inset.right = data.right : inset.right.type = data.right;
              }
              this.inset = inset;
            }
        })
      },
    }
  }
</script>
