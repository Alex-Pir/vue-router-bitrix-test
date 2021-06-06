<template>
  <div class="add-section-block">
    SecondPage
    {{id}}
    <template v-for="d in sectionAddData">
      {{d.name}}
    </template>
  </div>
</template>

<script>
 export default {
  name: 'SecondPage',
  data() {
    return {
      sectionName: ''
    }
  },
  props: {
    id: 0,
    sectionAddData: "Array"
  }
};

</script>