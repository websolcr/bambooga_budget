<template>
    <div :class="{'bg-green-50': isExpanded}">
      <div
        class="flex divide-x divide-green-default"
      >
        <div
          class="p-3 text-sm flex items-center justify-center text-center"
        >
          incomeSource.name1
        </div>  
        <div
          class="p-3 text-sm flex items-center justify-center text-center"
        >
          incomeSource.name1
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
      
    },


}
  </script>
  