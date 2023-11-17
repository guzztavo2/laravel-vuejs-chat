<template>
    <div class="input-group">
        <input
            id="btn-input"
            type="text"
            name="message"
            class="form-control input-sm fs-5 p-2"
            placeholder="Digite sua mensagem aqui"
            v-model="newMessage"
            @keyup.enter="sendMessage"
            @keydown="isTyping"
            @keyup="notTyping"
        />

        <span class="input-group-btn">
            <button
                class="btn fs-5 p-2 btn-success btn-sm"
                id="btn-chat"
                @click="sendMessage"
            >
                Enviar
            </button>
        </span>
        <span
            v-show="typing"
            v-if="user_typing !== null"
            class="help-block col-12"
            style="font-style: italic"
        >
            @{{ user_typing.name }} está digitando...
        </span>
    </div>
</template>

<script>
export default {
    props: ["user", "typing", "user_typing"],

    data() {
        return {
            newMessage: "",
        };
    },
    watch: {
        user_typing: function () {},
    },
    methods: {
        sendMessage() {
            this.$emit("messagesent", {
                user: this.user,
                message: this.newMessage,
            });

            this.newMessage = "";
        },
        isTyping() {
            this.$emit("useristyping", this.user);
        },
    },
};
</script>
