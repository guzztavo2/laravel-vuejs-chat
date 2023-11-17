/**
 * First we will load all of this project"s JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application"s views. An example is included for you.
 */

// const app = createApp({});

// import ExampleComponent from "./components/ExampleComponent.vue";
// app.component("example-component", ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob("./**/*.vue", { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split("/").pop().replace(/\.\w+$/, ""), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

// app.mount("#app");

// resources/assets/js/app.js


import { createApp, ref } from "vue";
import ChatMessages from "./components/ChatMessages.vue";
import ChatForm from "./components/ChatForm.vue";

let messages = ref([]);

const app = createApp({
    setup() {
        return {
            messages
        }
    },
    data() {
        return {
            typing: false,
            user_typing: null,
            friend: null

        };
    },
    created() {
        let _this = this;

        Echo.private("typing")
            .listenForWhisper("UserTyping", (e) => {

                _this.user_typing = e.userTyping;

                _this.typing = e.typing;

                setTimeout(function () {
                    _this.typing = false
                }, 1000);
            });

        this.fetchMessages();
    },
    mounted() {
        this.listen();
    },
    methods: {
        listen() {
            Echo.join('chat')
                .joining((user) => {
                    axios.put('/api/user/' + user.id + '/online?api_token=' + user.api_token, {});
                })
                .leaving((user) => {
                    axios.put('/api/user/' + user.id + '/offline?api_token=' + user.api_token, {});
                })
                .listen('UserOnline', (e) => {
                    this.friend = e.user;
                })
                .listen('UserOffline', (e) => {
                    this.friend = e.user;
                });
        },
        fetchMessages() {
            axios.get("/messages").then(response => {
                console.log(response.data);
                this.messages = response.data;
            })
        },

        addMessage(message) {

            axios.post("/messages", message).then(response => {
                console.log(response.data);
            });

            this.fetchMessages();
        },

        isTyping(user) {
            let channel = Echo.private("typing");
            setTimeout(() => {
                channel.whisper("UserTyping", {
                    userTyping: user,
                    typing: true,
                });
            }, 1000);
        },
    }
});

app.component("chat-messages", ChatMessages);
app.component("chat-form", ChatForm);

app.mount("#app");

Echo.private("chat")
    .listen("MessageSent", (e) => {
        messages.value.push({
            message: e.message,
            user: e.user,
            created_at: e.message.created_at,
            id: e.message.id,
            message: e.message.message,
            user: e.user,
            user_id: e.message.user_id,
        });
    });




