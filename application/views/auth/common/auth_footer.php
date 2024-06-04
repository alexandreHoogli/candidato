    <input id="csrf_token" type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
    
    <!-- Notification Start -->
    <div class="pxg_notification">
        <div class="pxg_notification_content">
            <div class="pxg_notification_icon ">
                <img class="success d-none" src="<?= base_url() ?>assets/images/success.png">
                <img class="error d-none" src="<?= base_url() ?>assets/images/oops.png">
            </div>
            <div class="pxg_notification_msg msg">
                <h4></h4>
                <p>
                </p>
            </div>
            <div class="pxg_notification_msg d-none">
                <h4></h4>
                <p>
                </p>
            </div>
            <div class="pxg_notification_close" onclick="$(this).closest('.pxg_notification').removeClass('success')" >
                <a href="javascript:;"><img src="<?= base_url() ?>assets/images/cancel.svg"></a>
            </div>
        </div>
    </div>
    <!-- Notification End -->
    <script>const baseurl = "<?= base_url() ?>"</script>

    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script> 
        <script src="<?= base_url() ?>assets/plugin/animation/js/wow.min.js"></script>
        <script src="<?= base_url() ?>assets/js/custom.js"></script> 
    </body>
</html>