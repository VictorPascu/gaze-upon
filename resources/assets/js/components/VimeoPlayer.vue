<template>
    <div class="vimeo-player-wrapper">
        <template v-if="playingItem.type=='Vimeo'">
            <iframe ref="vimeoPlayer" id="vimeo-player-embed"
                    src="https://player.vimeo.com/video/44474689?autoplay=1&color=fe0893&title=0&byline=0&portrait=0&0&muted=1&background=1"
                    class="responsive-vimeo-player"
                    frameborder="0"
                    webkitallowfullscreen
                    mozallowfullscreen
                    allowfullscreen>
            </iframe>
        </template>
    </div>
</template>

<script>
    export default {
        name: "VimeoPlayer",
        props: ['playingItem'],
        watch: {
            playingItem: function (newVal, oldVal) { // watch it
                window.ref.$emit('changed');
                console.log('Prop changed: ', newVal, ' | was: ', oldVal)
                this.vimeoChangePlayingItem(newVal);
            },
            deep: true
        },
        data: function () {
            return {
                vimeoPlayer: null,
                vimeoEmbed: null,
            }
        },
        methods: {
            vimeoChangePlayingItem: function (item) {
                if (item.type == "Vimeo") {
                    console.log("Loading new Vimeo content.");
                    var player = new Vimeo.Player(this.$refs.vimeoPlayer);

                    console.log(item);
                    console.log(item.videoId);

                    player.loadVideo(parseInt(item.videoId));
                } else {
                    console.log("Vimeo player asked to play non-Vimeo content.");
                }
            },
            init: function () {
                this.videoEmbed = this.$refs.vimeoPlayer;
                window.vimeoPlayer = new Vimeo.Player(this.$refs.vimeoPlayer);
                window.vimeoPlayer.setCurrentTime(6);
                window.vimeoPlayer.on('ended', function (data) {
                    console.log("Video ended (fire event)");
                    window.ref.$emit('ended');
                });
            },
            restartVideo: function () {
                window.vimeoPlayer.setCurrentTime(0);
                console.log("Restarted video.");
            }
        },
        mounted() {
            window.ref = this;
            console.log('VimeoPlayer mounted.');
            window.ref.init();
        }
    }
</script>

<style scoped>
    .vimeo-player-wrapper {
        padding: 56.25% 0 0 0;
        position: relative;
    }

    .responsive-vimeo-player {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>