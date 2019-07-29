<template>
    <div class="chat-app bg-light">
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        <ContactsList :contacts="contacts" @selected="startTrigger"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';
import { setInterval, clearInterval } from 'timers';

    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },

        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: [],
                trigger: null
            };
        },

        mounted() {
            console.log(this.user);
            axios.get('/contacts')
                .then((response) => {
                    console.log(response.data);
                    this.contacts = response.data;
                })
        },

        methods: {
            startConversationWith(contact) {
                //this.updateUnreadCount(contact, true);
                console.log(contact.id);
                var selectedID = contact.id;
                axios.get('/conversation/' + selectedID)
                    .then((response) => {
                        console.log(response.data);
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },
            startTrigger(contact) {
                clearInterval(this.trigger);
                this.trigger = setInterval(() => {
                    this.startConversationWith(contact);
                }, 1000);
            },
            saveNewMessage(message) {
                this.messages.push(message);
            }
        },

        components: {
            'Conversation': Conversation,
            'ContactsList': ContactsList
        }
    }
</script>

<style lang="scss" scoped>
.chat-app {
    display: flex;
}
</style>
