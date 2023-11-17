<!-- resources/views/chat.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 w-100">
                <div class="panel panel-default w-100">
                    <div class="panel-heading text-center fw-lighter fs-4">Chats</div>


                    <div class="col-12">
                        <div class="panel-body">
                            <chat-messages :user="{{ Auth::user() }}" :messages="messages"></chat-messages>
                        </div>
                        <div class="panel-footer">

                            <chat-form v-on:useristyping="isTyping" v-on:messagesent="addMessage" :user="{{ Auth::user() }}"
                                :typing="typing" :user_typing="user_typing"></chat-form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
