<template>
    <div class="youtube-player-wrapper">
        <youtube player-height="1080" player-width="1920" :player-vars="{start: 0, autoplay: 1}" :video-id="playingItem.videoId" ref="youtube" @playing="playing" @ready="onPlayerReady"></youtube>
    </div>
</template>

<script>
    export default {
        name: "YoutubePlayer",
        props: ['playingItem'],
        watch: {
            playingItem: function (newVal, oldVal) { // watch it
                window.ref.$emit('changed');
                console.log('Prop changed: ', newVal, ' | was: ', oldVal);


                this.pauseVideo();
                if (this.player.getPlayerState() !== 1) {
                    console.log("Not playing...");
                    this.playVideo();
                }
            },
            deep: true
        },
        methods: {
            pauseVideo() {
                this.player.pauseVideo();
            },
            playVideo() {
                this.player.playVideo()
            },
            playing() {
                console.log('\o/ we are watching!!!')
            },
            onPlayerReady() {
                console.log('hey');
                this.playVideo();
            }
        },
        computed: {
            player() {
                return this.$refs.youtube.player
            }
        }
    }
</script>

<style scoped>
    .youtube-player-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>