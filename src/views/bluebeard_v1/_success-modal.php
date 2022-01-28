<div class="modal__wrapper">
    <img src="<?= ASSETS . THEME . 'images/bg/' . $data['checkout_message'] . '-modal.png' ?>">
</div>


<style>

.modal__wrapper {
    border-radius: 30px;
    box-shadow: rgba(100, 100, 111, 0.4) 0px 7px 29px 0px;
    /* height: 555px; */
    position: fixed;
    /* max-height: 80%; */
    max-width: 900px;
    width: 90%;
    z-index: 99999;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    display: none;
    overflow: hidden;
}

.modal__wrapper img {
    width: 100%;
    height: 100%;
}

</style>