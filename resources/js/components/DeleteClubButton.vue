<template>
  <div>
    <a class="button is-danger" @click="showModal = true">
      <span class="icon is-small">
        <i class="fas fa-ban"></i>
      </span>
      <span>
        このクラブを削除する
      </span>
    </a>
    <Modal
      :class="{ 'is-active': showModal }"
      @close="showModal = false"
    >
      <div slot="modal-content">
        <div class="box is-clearfix">
          <h3 class="subtitle">「{{ club.name }}」を削除します</h3>
          <p class="content">
            よろしいですか？
          </p>
          <div class="field is-grouped is-pulled-right">
            <div class="control">
              <button
                class="button is-danger"
                @click="destroyClub">
                <span class="icon is-small">
                  <i class="fas fa-ban"></i>
                </span>
                <span>
                  削除する
                </span>
              </button>
              <button
                class="button"
                @click="showModal = false">
                キャンセル
              </button>
            </div>
          </div>
        </div>
      </div>
    </Modal>
  </div>
</template>

<script>
import Modal from "@/components/Modal";

export default {
  props: {
    club: {
      type: Object,
      default: {}
    }
  },
  components: {
    Modal
  },
  data() {
    return {
      showModal: false
    };
  },
  methods: {
    destroyClub() {
      this.$store.dispatch('club/destroyClub', this.club)
        .then(response => {
          this.$store.dispatch('flash/update', {type: 'is-primary', message: '削除しました'});
          this.$router.push('/');
        })
        .catch(error => {
          this.$store.dispatch('flash/update', {type: 'is-danger', message: '通信エラーが発生しました'});
        });
    }
  }
};
</script>
