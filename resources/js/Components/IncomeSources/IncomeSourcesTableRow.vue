<template>
    <div :class="{'bg-green-50': isExpanded}">
      <div
        class="flex divide-x divide-green-default"
      >
        <div
          v-if="columnVisibility.index.visible"
          class="p-3 text-sm flex items-center justify-center text-center"
          :style="{width: columnVisibility.index.width}"
        >
          {{ index }}
        </div>
        <div
          v-if="columnVisibility.name.visible"
          class="p-3 text-sm flex items-center justify-center text-center"
          :style="{width: columnVisibility.name.width}"
        >
          {{ incomeSource.name }}
        </div>  
        <div
          v-if="columnVisibility.amountDetails.visible"
          class="p-3 text-sm flex items-center justify-center text-center"
          :style="{width: columnVisibility.amountDetails.width}"
        >
          <IncomeSourceDetailsRow />
        </div>  
        <div
          v-if="columnVisibility.edit.visible"
          class="p-3 text-sm flex items-center justify-center text-center"
          :style="{width: columnVisibility.edit.width}"
        >
          <AppButton 
            label="Edit"
            @click="selectIncomeSource"
          />      
        </div>    
      </div>      
    </div>
  </template>
  
  <script>
import AppButton from '../AppButton.vue';
import IncomeSourceDetailsRow from './IncomeSourceDetailsRow.vue';

  
//   import {isNull} from "lodash"
    
  export default {
      name: 'IncomeSourcesTableRow',

      components: {
        AppButton,
        IncomeSourceDetailsRow,
      },
  
      props: {
        incomeSource: {
              type: Object,
              required: true,
          },
  
          index: {
              type: Number,
              required: true,
          },
          columnVisibility: {
            type: Object,
            required: true,
        },
    },
  
    data() {
        return {
            isExpanded: false,
            familyDetails: [],
            shouldLoad: false,
        }
    },

    methods: {
      selectIncomeSource() {
            this.$emit('select', this.incomeSource)
        },
    },


}
  </script>
  