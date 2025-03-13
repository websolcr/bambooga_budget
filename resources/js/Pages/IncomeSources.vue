<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import AppButton from "@/Components/AppButton.vue";
import IncomeSourceEditWidget from '@/Components/IncomeSources/IncomeSourceEditWidget.vue';
import IncomeSourcesTable from '@/Components/IncomeSources/IncomeSourcesTable.vue';
import {uniqueId} from "lodash";

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
        await this.fetchIncomeSources()
    },

    methods: {
        async fetchIncomeSources() {
            const { data } = await $http.get('income-sources')
            this.incomeSources = data
            return data
        },

        selectIncomeSource(incomeSource) {
            this.selectedIncomeSource = {...incomeSource}
            this.isOpenIncomeSourceEditWidget = true
        },

        addNewIncomeSource() {
            const newIncomeSource = {
                id: null,
                name: '',
                amount_details: [
                    {
                        id: uniqueId('amount_details'),
                        amount: null,
                        valid_from: '',
                        is_new: true,
                    }
                ],
                is_new: true
            }

            this.selectIncomeSource(newIncomeSource)
        },

        async save(incomeSource) {
            // this.$wait.start('saving-income-source')
            const uri = incomeSource.id ? `income-sources/${incomeSource.id}` : 'income-sources'

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
    <AppLayout title="ආදායම් මාර්ග">
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
