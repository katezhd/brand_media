<template>
    <div class="video" v-if="content.video_code">
        <div class="article__video-wrap inset-height" :style="{ 'background-image': 'url(/storage/youtube/' + content.image + ')' }" :data-id='content.video_code'>
            <button class="play-btn play-btn--news play-btn--break" style="" @click="initVideoPlayer(content.video_code, $event)">
                <svg>
                    <use xlink:href="#play"></use>
                </svg>
            </button>
        </div>
    </div>
    <div class="quote inset-height" v-if="!content.video_code" style="justify-content: center;">
        <div class="inset-error" style="margin: 0;">
            <span>К сожалению, данные сейчас недоступны</span>
            <svg>
                <use xlink:href="#cryEmoji"/>
            </svg>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['content'],
        mounted() {
            if(this.content.image) {
                this.image = this.storage + this.content.image;
            }
        },
        methods: {
            initVideoPlayer(video_code, event) {
                event.target.parentElement.innerHTML =`
                <iframe
                    src="https://www.youtube.com/embed/${video_code}?autoplay=1&mute=1" frameborder="0" allowfullscreen>
                </iframe>
                `
            }
        }
    }
</script>
