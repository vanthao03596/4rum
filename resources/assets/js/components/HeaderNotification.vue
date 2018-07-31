<template>
    <div>
        <div class="navbar">
            <div class="button" @click.prevent="show">
                <a href="#" id="notificationLink">
                    <i class="fa fa-globe"></i>
                </a>
                <span class="button__badge">{{ notiCount }}</span>
            </div>
            <!-- <div class="button">
        <i class="fa fa-comments"></i>
        <span class="button__badge">4</span>
      </div> -->
        </div>

        <div id="notificationContainer">
            <div id="notificationTitle">Notifications</div>
            <div id="notificationsBody" class="notifications">
                <div  id="DIV_1" v-for="(notification,index) in notifications" :key="index">
                    <div  id="DIV_2">
                        <div id="DIV_4">
                            <div id="DIV_5">
                                <img alt="" :src="notification.data.avatar"
                                    class="IMG_6" />
                            </div>
                            <div id="DIV_7">
                                <div id="DIV_8">
                                    <div id="DIV_9">
                                        <div id="DIV_10">
                                            <span id="SPAN_11"></span>
                                        </div>
                                        <div id="DIV_12">
                                            <div id="DIV_13">
                                                <div id="DIV_14">
                                                    <span @click.prevent="markAsRead(notification)" id="SPAN_15">
                                                        {{ notification.data.message }}
                                                    </span>
                                                    <div id="DIV_20">
                                                        <div id="DIV_21">
                                                            <img src="https://static.xx.fbcdn.net/rsrc.php/v3/y4/r/yI-vSS6j2ZC.png" alt="" id="IMG_22" />
                                                        </div>
                                                        <div id="DIV_23">
                                                            <div id="DIV_24">
                                                                <div id="DIV_25">
                                                                    <span id="SPAN_26"></span>
                                                                </div>
                                                                <div id="DIV_27">
                                                                    <abbr title="Thứ Bảy, 28 Tháng 7, 2018 lúc 09:29" id="ABBR_28">
                                                                        <span id="SPAN_29">{{ notification.created_at | moment}}</span>
                                                                    </abbr>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul id="UL_30">
                        <li id="LI_31">
                            <div id="DIV_32">
                            </div>
                        </li>
                        <li id="LI_33">
                            <div id="DIV_34">
                                <a href="#" id="A_35"></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="notificationFooter">
                <a href="/">See All</a>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
    
    export default {
        mounted() {
            Echo.private('App.User.' + window.App.user.id)
                .notification((notification) => {
                    toastr.options = {
                        "closeButton": false,
                        "debug": true,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-bottom-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                    toastr.info('<a href="' + notification.data.link + '" target="_blank">' + notification.data.message + '</a>')
                    this.notifications.push(notification);
                })
        },
        data() {
            return {
                notifications: false
            }
        },
        filters: {
            moment: function (date) {
                return moment(date).fromNow();
            }
        },
        computed: {
            notiCount() {
                return this.notifications.length
            },

        },
        created() {
            axios.get("/profile/" + window.App.user.name + "/notifications")
                .then(res => this.notifications = res.data);
        },
        methods: {
            show() {
                this.notiCount = 0;
                $("#notificationContainer").fadeToggle(300);
                // $("#notification_count").fadeOut("slow");
            },
            markAsRead(notification) {
                window.location.href = notification.data.link
                axios.delete('/profile/' + window.App.user.name + '/notifications/' + notification.id)
            }
        }
    }
</script>