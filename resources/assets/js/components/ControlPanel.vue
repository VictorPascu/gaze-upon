<template>

    <div>
        <!--<form action="" method="post">-->
        <div class="card" style="margin-top: 20px; margin-bottom: 20px;">
            <div class="card-body">
            <h2>Play new video</h2>

                <p>Example inputs:</p>
                <ul>
                    <li>
                        https://vimeo.com/153792259
                    </li>
                    <li>
                        https://www.youtube.com/watch?v=JjaYW5Cnr5k
                    </li>
                </ul>

                <label for="URL">Video URL</label>
                <input type="text" class="form-control" name="URL" v-model="url">
                <br>
                <button class="btn btn-primary btn-load-new-item" @click="loadNewItem"> Load</button>
            </div>
        </div>


        <!--</form>-->
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                url: "",
                itemToPlay: "",
            }
        },

        methods: {
            loadNewItem: function () {
                console.log("Loading new item");

                // https://www.youtube.com/watch?v=yozybDXGyFA
                // https://vimeo.com/177313319

                if (this.url.indexOf("youtube.com") !== -1) {
                    let videoId = this.url.substring(this.url.indexOf("?v=") + 3);
                    console.log(videoId);
                    this.itemToPlay = {"type" : "Youtube", "duration" : 1000, "path": this.url, "id" : videoId, "videoId": videoId};
                    this.playNewItem();
                }

                if (this.url.indexOf("vimeo.com") !== -1) {
                    let videoId = this.url.substring(this.url.lastIndexOf("/") + 1);
                    console.log(videoId);
                    this.itemToPlay = {"type" : "Vimeo", "duration" : 1000, "path": this.url, "id" : videoId, "videoId": videoId};
                    this.playNewItem();
                }
                console.log(this.url);
            },

            playNewItem: function() {
                console.log('Playing new item');
                let ref = this;
                $.ajax({
                    type: "POST",
                    url: '/play-item',
                    data: {
                        'body': ref.itemToPlay,
                        'feedname': 'global-screens.default',
                        '_token': window.Laravel.csrfToken
                    },
                    success: function(data){
                        console.log("Success");
                    }
                });
            }
        },
        mounted() {
            console.log('Control Panel Component mounted.');
        },

    }
</script>
