<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import AppButton from "@/Components/AppButton.vue";
import IncomeSourceEditWidget from '@/Components/IncomeSources/IncomeSourceEditWidget.vue';
import { inject, onMounted, ref } from 'vue'
import IncomeSourcesTable from '@/Components/IncomeSources/IncomeSourcesTable.vue';

export default {
    name: 'IncomeSources',

    components: {
        AppLayout,
        AppButton,
        IncomeSourceEditWidget,
        IncomeSourcesTable,
    },
    

    data() {
        return {
            incomeSources: [],
            selectedIncomeSource: null,
            isOpenIncomeSourceEditWidget: false,
        }
    },

    async created() {
        this.fetchIncomeSources()
    },

    methods: { 
        async fetchIncomeSources() {
            const { data } = await $http.get('income-sources')
            console.log(data)
            this.incomeSources = data    
            return data
        },

        selectIncomeSource(incomeSource) {
            this.selectedIncomeSource = {...incomeSource}
            console.log(incomeSource)
            this.isOpenIncomeSourceEditWidget = true
        },

        addNewIncomeSource() {
            const newIncomeSource = {
                id: null,
                name: '',
            }

            this.selectIncomeSource(newIncomeSource)    
        },

        async save(incomeSource) {
            // this.$wait.start('saving-income-source')

            const uri = incomeSource.id ? `income-sources/${incomeSource.id}` : 'income-sources'

            console.log(uri)
            const method = incomeSource.id ? 'put' : 'post'

            await $http[method](uri, incomeSource)

            // this.$wait.end('saving-income-source')

            this.isOpenIncomeSourceEditWidget = false

            return await this.fetchIncomeSources()
        },
    },
}
</script>

<template>
    <AppLayout title="ආදායම්_මාර්ග">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ආදායම්_මාර්ග
            </h2>
        </template>
        <template #top-button>
            <app-button
                label="ආදායම් මාර්ගයක් ඇතුලත් කරන්න"
                @click="addNewIncomeSource"
            />
    </template>
        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8 space-y-2">
                <IncomeSourcesTable 
                    :incomeSources="incomeSources"
                    @select="selectIncomeSource"
                />
            </div>
        </div>

        <IncomeSourceEditWidget
            :incomeSource="selectedIncomeSource"
            :is-showing="isOpenIncomeSourceEditWidget"
            @save="save"
            @close="isOpenIncomeSourceEditWidget = false"
        />
    </AppLayout>
</template>