<template>
    <ul style="overflow: auto; height: 70vh" class="chat chat-window">
        <li
            style="list-style: none"
            class="left clearfix d-flex justify-content-end"
            v-for="message in messages"
        >
            <div
                class="chat-body mw-100 col-auto clearfix border border-dark bg-secondary bg-opacity-50 border-opacity-50 py-2 my-2 d-flex flex-column justify-content-center rounded"
                :class="{ 'bg-success': message.user.name == user.name }"
            >
                <div class="header px-2">
                    <strong class="primary-font fs-6">
                        {{ message.user.name }}
                    </strong>
                </div>
                <p
                    style="word-wrap: normal; word-break: break-all"
                    class="fs-5 mw-100 p-0 my-2 bg-light bg-opacity-75 p-2"
                >
                    {{ message.message }}
                </p>
                <div class="col-12 fs-6 d-flex justify-content-end px-2">
                    <p class="p-0 m-0">{{ message.created_at }}</p>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
export default {
    props: ["messages", "user"],
    mounted() {
        this.$watch(
            "messages",
            function () {
                this.$nextTick((_) => {
                    this.$el.scroll({
                        top: this.$el.scrollHeight,
                        behavior: "smooth",
                    });
                });
            },
            { deep: true }
        );

        this.$nextTick(() => {
            setTimeout(() => {
                this.$el.scroll({
                    top: this.$el.scrollHeight,
                    behavior: "smooth",
                });
            }, 500);
        });
    },
};
</script>
