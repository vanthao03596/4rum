<template>
<div>
<div class="navbar">
      <div class="button">
        <a href="#" id="notificationLink" @click.prevent="show"><i class="fa fa-globe"></i></a>
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
                <div v-for="(notification,index) in notifications" class="content">
                 <a :href="notification.data.link">
                    <img src="https://randomuser.me/api/portraits/men/8.jpg" width="50px" height="50px" alt="profpic">
                    {{ notification.data.message }}
                </a>
                </div>

        </div>
        <div id="notificationFooter"><a href="/">See All</a></div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            notifications  : false
        }
    },
    computed : {
        notiCount() {
            return this.notifications.length
        }
    },
    created() {
        axios.get("/profile/" + window.App.user.name + "/notifications")
            .then(res => this.notifications = res.data);
    },
    methods : {
        show() {
            $("#notificationContainer").fadeToggle(300);
              // $("#notification_count").fadeOut("slow");
        }
    }
}
</script>
