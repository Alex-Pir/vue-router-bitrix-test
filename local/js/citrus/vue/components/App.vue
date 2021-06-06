<template>
  <div class="add-section-block">
    <keep-alive>
    <router-view />
    </keep-alive>
  </div>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      sectionName: ''
    }
  },
  props: {
    sectionAddData: "Array"
  }
}
</script>