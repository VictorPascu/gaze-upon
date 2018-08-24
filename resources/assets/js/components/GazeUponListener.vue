<template>
    <div>
        <div class="page-wrapper">
            <!--<vimeo-player v-bind:id="this.playingItem.id"></vimeo-player>-->
            <template v-if='this.playingItem.type === "Vimeo"'>
                <vimeo-player v-bind:playingItem="this.playingItem" v-on:ended="this.vimeoEnded"></vimeo-player>
            </template>
            <template v-if='this.playingItem.type === "YouTube"'>
                <youtube-player v-bind:playingItem="this.playingItem" v-on:ended="this.youtubeEnded"></youtube-player>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['feedname'],
        data: function () {
            return {
                playingItem: {'Type': null, 'Duration': '0', 'path': 'vimeo.com/170496609', 'id': '170496609', 'videoId': '170496609'},
                vimeoPlayer: null,
                vimeoEmbed: null,
                playMode: 'queue',
                shuffle: true,
                queue: [
                    {'type': 'YouTube', 'duration': '40', 'id': 'yozybDXGyFA',  'videoId': 'yozybDXGyFA'},
                    {'type': 'YouTube', 'duration': '93', 'path': 'https://www.youtube.com/watch?v=JjaYW5Cnr5k&t', 'id': 'yozybDXGyFA',  'videoId': 'yozybDXGyFA'},
                    {'type': 'Vimeo', 'duration': '30', 'path': 'vimeo.com/208158232', 'id': '170496609', 'videoId': '170496609'},
                    {'type': 'Vimeo', 'duration': '96', 'path': 'vimeo.com/170496609', 'id': '170496609', 'videoId': '170496609'},
                    {'type': 'YouTube', 'duration': '193', 'path': 'https://www.youtube.com/watch?v=GbzUuPRFg-M', 'id': 'JjaYW5Cnr5k&t',  'videoId': 'yozybDXGyFA'},
                    {'type': 'YouTube', 'duration': '40', 'path': 'https://www.youtube.com/watch?v=yozybDXGyFA', 'id': 'JjaYW5Cnr5k&t',  'videoId': 'yozybDXGyFA'}
                ]
            }
        },
        methods: {
            getPlayingId : function () {
                return 208158232;
            },

            playRandomItemFromQueue: function (avoid = null) {
                let ref = this;

                let nextItem = this.getRandomInt(0, this.queue.length - 1);
                this.playItem(this.queue[nextItem]);
            },

            playItem: function (playableItem) {
                console.log(playableItem);
                this.playingItem = playableItem;
                console.log("Playing new item.");
            },
            getRandomInt: function (min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            },

            vimeoEnded: function () {
                console.log("Listener received end event, playing new random queue item.");
                this.playRandomItemFromQueue();
            },

            youtubeEnded: function () {
                console.log("Listener received end event, playing new random queue item.");
                this.playRandomItemFromQueue();
            },

            pickVideoFromPool: function (videoIdsToChooseFrom, id) {

                let idList = videoIdsToChooseFrom;
                let avoidId = id;

                let currentVideoIndex = idList.indexOf(avoidId);

                if (currentVideoIndex > -1) {
                    idList.splice(currentVideoIndex, 1);
                    console.log("Excluded current video " + id + " from rerolls " + currentVideoIndex);
                }

                console.log("Will pick from: " + idList);

                let videoToLoadIndex = this.getRandomInt(0, idList.length - 1);

                let videoToLoad = idList[videoToLoadIndex];
                console.log("Video to load: " + videoToLoad);

                return videoToLoad;
            },

            // playItem: function (item) {
            //     console.log("Changing playing item...");
            //     this.playingItem = item;
            //
            //     if (item.type == "Vimeo") {
            //         var player = new Vimeo.Player(this.$refs.vimeoPlayer);
            //
            //         console.log(item);
            //         console.log(item.videoId);
            //
            //         player.loadVideo(parseInt(item.id));
            //     }
            // },

            restartRandomVideo: function () {
                console.log("Restarting...");
                ref.loadRandomVideo();
            },

            pickAndPlayNextVideo: function (player, videoIdsToChooseFrom, id) {
                let nextVideoToLoad = ref.pickVideoFromPool(videoIdsToChooseFrom, id);

                if (nextVideoToLoad != null) {
                    player.loadVideo(nextVideoToLoad).then(function (id) {
                        // the video successfully loaded
                        player.setLoop(false);
                    }).catch(error => {
                        switch (error.name) {
                            case 'TypeError':
                                // the id was not a number
                                console.log("ID was not a number")

                                break;

                            case 'PasswordError':
                                // the video is password-protected and the viewer needs to enter the
                                // password first
                                console.log("Password error")
                                ref.restartRandomVideo();

                                break;

                            case 'PrivacyError' || "errorNotFoundError":
                                // the video is password-protected or private
                                console.log("Privacy error")
                                ref.restartRandomVideo();

                                break;

                            default:
                                // some other error occurred
                                console.log(error)
                                ref.restartRandomVideo();
                                break;


                        }
                    });
                } else {
                    ref.restartRandomVideo();
                }
            },

            loadRandomVideo: function () {
                console.log("Loading random video!");

                //
                // console.log(window.vimeoPlayer);
                //var player = window.vimeoPlayer;
                // player.destroy();
                var player = new Vimeo.Player(window.ref.$refs.vimeoPlayer);
                player.setLoop(false);
                // window.vimeoPlayer = player;

                console.log("Locked player.");
                // 247064057
                //177313319
                let allVideoIds = [44474689, 195530484, 217753937];
                let videoIdsToChooseFrom = allVideoIds.slice();

                console.log("Getting video id");

                return ref.pickAndPlayNextVideo(player, videoIdsToChooseFrom, null);

                // player.getVideoId().then(function (id) {
                //     let nextVideoId = ref.pickAndPlayNextVideo(player, videoIdsToChooseFrom, id);
                //     return nextVideoId;
                // }).catch()
                // {
                //     ref.pickAndPlayNextVideo(player, videoIdsToChooseFrom, null);
                //     console.log("Picking any next video - failed to get playing vid id.");
                // };
            },

            startListener: function () {
                let ref = this;

                let feed = 'global-screens.' + this.feedname;

                console.log('Listening to ' + feed);

                Echo.channel(feed)
                    .listen('PlayNewItem', (e) => {
                        console.log('Received play new item event: ' + e);
                        console.log(e);


                        let playableItem = e.newItem;
                        playableItem.internalId = e.newItem.id;
                        playableItem.id = e.videoId;
                        playableItem.videoId = e.videoId;
                        playableItem.type = e.type;

                        console.log(ref.playingItem);

                        ref.playingItem = playableItem;

                        console.log("Playing item...");
                        console.log(playableItem);

//                        ref.playItem(playableItem);
                    })
            }
            // init: function () {
            //     this.videoEmbed = this.$refs.vimeoPlayer;
            //     window.vimeoPlayer = new Vimeo.Player(this.$refs.vimeoPlayer);
            //
            //     window.vimeoPlayer.setCurrentTime(6);
            //     window.vimeoPlayer.on('ended', function (data) {
            //         console.log("Video ended");
            //         return window.ref.loadRandomVideo();
            //     });
            // }
        },
        mounted() {
            window.ref = this;
            console.log('GazeUponListener mounted.');
            window.ref.startListener();

            if (this.playMode === 'queue') {
                if (this.shuffle === true) {
                    this.playRandomItemFromQueue();
                }
            }
        }
    }
</script>

<style>

</style>