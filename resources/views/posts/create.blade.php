@extends('layouts.master')

@section('content')

    <div class="col-sm-8 blog-main">
        <h1>Create a Post</h1>

        <hr>

        <form method = "POST" action= "/posts" >

                {{ csrf_field() }} <!-- protection against Cross Site Request Forgery -->

                <div class="form-group">
                  <label for="title">Title: </label>
                  <input type="text" class="form-control" id="title" name = "title" placeholder="Title"> <!-- can use required -->
                </div>

                <div class="form-group">
                  <label for="body">Body: </label>
                  <textarea class="form-control" id="body" name = "body"></textarea>
                </div>

                <div class = "form-group">
                  <button type="submit" class="btn btn-primary">Publish</button>
                </div>
                  
        </form>

        @include('layouts.errors')

    </div>

@endsection