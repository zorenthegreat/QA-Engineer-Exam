<template>
    <div>
        <video ref="videoElement" class="video-js"></video>
        <button @click="switchVideoSource">Switch Source</button>
    </div>
</template>

<script>
import videojs from 'video.js'
import 'video.js/dist/video-js.css'

export default {
    name: 'VideoPlayer',
    data() {
        return {
            player: null,
            sources: [],
            currentSourceIndex: 0,
        }
    },
    created () {
        this.fetchVideos()
    },
    methods: {
        switchVideoSource() {
            this.currentSourceIndex = (this.currentSourceIndex + 1) % this.sources.length

            this.player.src(this.sources[this.currentSourceIndex])

            this.player.load()
            this.player.play()
        },
        async fetchVideos () {
            await axios.get(route('api.videos')).then(response => {
                response.data.videos.forEach((video, key) => {
                    this.sources[key] = video.split('\\').join('/')
                })
                
                this.player = videojs(this.$refs.videoElement, {
                    sources: this.sources,
                    controls: true,
                })
            }).catch(error => {
                console.error('Error fetching data:', error)
            })
        },
    },
    beforeUnmount() {
        if (this.player) {
            this.player.dispose()
        }
    },
}
</script>

<style scoped="">
.video-js {
    width: 100%;
    height: 600px;
}
</style>