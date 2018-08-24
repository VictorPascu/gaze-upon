@extends('layouts.app')

@section('content')

<div class="container">

    <div id="vue-app">
        <control-panel></control-panel>
    </div>

    <div class="card" style="margin-top: 20px; margin-bottom: 20px;">
        <div class="card-body">
            <h2>Play preset videos</h2>
            <button class="btn btn-primary video1-btn">Play video 1</button>
            <button class="btn btn-primary video2-btn">Play video 2</button>
            <button class="btn btn-primary video3-btn">Play video 3</button>
        </div>
    </div>

<div class="card">
    <div class="card-body">
        <h2>Create Feed</h2>
        <p>
            Feeds run playlists. A playlist is a set of playable items that runs in sequence. A feed keeps track of
            where in the playlist it is, iterates through elements, and allows newly-joining listeners to start off
            at the correct position.
        </p>

        <form action="create-feed" method="POST">

            <label>Name</label>
            <input class="form-control" type="text">

            <br>
            <button class="btn btn-primary">Add Feed</button>

        </form>
    </div>
</div>

</div>

<script>
    $('.video1-btn').click(function () {
        console.log("Playing 1");
        $.ajax({
            url: "/play-video1",
            context: document.body
        }).done(function () {

        });
    })

    $('.video2-btn').click(function () {
        console.log("");
        $.ajax({
            url: "/play-video2",
            context: document.body
        }).done(function () {

        });
    })

    $('.video3-btn').click(function () {
        console.log("");
        $.ajax({
            url: "/play-video3",
            context: document.body
        }).done(function () {

        });
    })
</script>

@endsection