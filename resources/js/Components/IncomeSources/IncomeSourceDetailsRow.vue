<template>
    <div :class="{'bg-green-50': isExpanded}">
      <div
        class="flex divide-x divide-green-default"
      >
        <div
          class="p-3 text-sm flex items-center justify-center text-center w-1/2"
        >
          {{ amountDetail.amount }}
        </div>  
        <div
          class="p-3 text-sm flex items-center justify-center text-center w-1/2"
        >
          {{ amountDetail.valid_from }}
        </div>
        <div
          class="p-3 text-sm flex items-center justify-center text-center w-1/2"
        >
          {{ amountDetail.valid_end }}
        </div> 
        <div
          class="p-3 text-sm flex items-center justify-center text-center w-1/2"
        >
          {{ amountDetail.payment_cycle }}
        </div>      
      </div>  
    </div>
  </template>
  
  <script>
    
  export default {
      name: 'IncomeSourceDetailsRow',

      components: {
        
      },
  
      props: {
        amountDetail: {
              type: Object,
              required: true,
          },
    },
  
    data() {
        return {
            isExpanded: false,
        }
    },

    methods: {
      
    },


}
  </script>
  