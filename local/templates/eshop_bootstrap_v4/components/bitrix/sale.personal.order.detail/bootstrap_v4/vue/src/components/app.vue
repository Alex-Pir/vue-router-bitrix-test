<template>
  <div class="table-responsive">
    <table class="table" v-if="products.length > 0">
      <thead>
      <tr>
        <td scope="col">Наименование</td>
        <td scope="col">Цена</td>
        <td scope="col">Количество</td>
        <td scope="col">Сумма</td>
        <td scope="col" v-if="isField">Удалить</td>
      </tr>
      </thead>
      <tbody>
        <tr class="container"
             v-for="product in filteredProducts"
             :key="product.id"
             :class="{delete: product.isDelete}"
        >
          <td class="sale-order-detail-order-item-properties">{{product.name}}</td>
          <td class="sale-order-detail-order-item-properties">{{product.price}} руб.</td>
          <td class="sale-order-detail-order-item-properties">
            <div class="change-block">
              <transition name="fade">
                <div class="block" v-if="!isField">
                  {{product.count}}
                </div>
                <input class="change-text" type="text" v-model="product.count" @keyup="inputChange(product)" v-if="isField"/>
              </transition>
            </div>
          </td>
          <td class="sale-order-detail-order-item-properties"><animatedNumber :number="product.sum"/></td>

          <td class="order-detail-header-column" v-if="isField">
            <input class="order-detail-product-delete" type="checkbox" @change="removeCheck(product)" v-model="product.isDelete"/>
          </td>

        </tr>
      </tbody>
    </table>
    <div v-else>
      Нет товаров в заказе
    </div>
    <div class="reload-button" v-if="products.length > 0">
      <button class="button-for-change" @click="changeForText()" v-if="!isField">Изменить</button>
      <button class="button-for-change" @click="saveChanges()" v-else>Сохранить</button>
    </div>
  </div>
</template>

<script>

import animatedNumber from './animated-number.vue'

export default {

  props: {
    arProduct: "Array"
  },
  data() {
    return {
      products: this.arProduct,
      isField: false,
      inputSearch: ''
    }
  },
  mounted() {
    for (let i = 0; i < this.arProduct.length; i++)
    {
      this.arProduct[i].changeCount = this.arProduct[i].count;
      this.arProduct[i].isDelete = false;
    }
  },
  computed: {

    /**
     * Осуществляет поиск по названию товара в массиве products
     */
    filteredProducts() {
      return this.products.filter(t => {

        let name = t.name.toLowerCase();
        let search = this.inputSearch.toLowerCase();

        return name.indexOf(search) != - 1;
      });
    }
  },
  components: {
    animatedNumber
  },
  methods: {
    /**
     * Изменяет блок с текстом на поле для ввода
     */
    changeForText() {
      console.log(this.products);
      this.isField = true;
    },

    /**
     * Сохраняет введенные значения
     */
    saveChanges() {
      this.isField = false;
      this.products = this.products.filter(t => t.isDelete === false);
    },

    /**
     * Изменяет стоимость товара
     * @param id
     */
    inputChange(product) {
      if (!product.isDelete)
      {
        product.sum = product.count * product.price;
      }
    },

    removeCheck(product) {
      if (product.isDelete)
      {
        product.sum = 0;
      }
      else
      {
        product.sum = product.count * product.price;
      }
    }
  }
}
</script>

<style scoped>
.reload-block-item {
  display: table;
  flex-flow: column;
  justify-content: space-between;

}

.table-header {
  border-bottom: 2px solid #000;
}

.order-detail-header-column {
  display: table-cell;
  width: 200px;
  height: 30px;
  max-height: 30px;
  box-sizing: border-box;
  position: relative;
  max-width: 200px;
}

.container {
  display: table-row;
  max-height: 30px;
  box-sizing: border-box;
}



.block,
.change-text{
  width: 100px;
}

.change-text {
  padding: 2px 5px;
  box-sizing: border-box;
}

.detail-order-header
{
  display: table-row;
}

.change-block
{
  display: flex;
  max-width: 100px;
  position: absolute;
}

.delete {
  text-decoration: line-through;
}

.order-detail-product-delete {
  position: absolute;
}


.fade-enter-active, .fade-leave-active {
  transition: padding 0.5s, width 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
  width: 0;
  padding: 0 !important;
}

</style>