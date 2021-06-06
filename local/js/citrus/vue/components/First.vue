<template>
  <div class="add-section-block">
    <input type="text" name="sectionAdd" v-model="sectionName"/>
    <span class="btn btn-default section-add-js">DOBAVIT</span>
    <router-link :to="{ name: 'foo', params: { id: 12, sectionAddData: [{id: 25, name: 'TEST'}, {id: 96, name: 'ALL_RIGHT'}] } }">Перейти к Foo</router-link>
  </div>
</template>

<script>
export default {
  name: 'First',
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