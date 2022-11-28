<template>
    <div class="margin-top">
        <div v-if="payouts?.length">
            <CustomeTable>
                <template v-slot:table-head>
                    <tr class="text-primary">
                        <th class="text-center">Place</th>
                        <th>Name</th>
                        <th class="text-center hide-on-mobile">Country</th>
                        <th class="text-right">
                            Prize (<span v-html="currency"></span>)
                        </th>
                    </tr>
                </template>
                <template v-slot:table-body>
                    <tr v-for="(payout, index) in payouts" :key="index">
                        <td class="text-center">
                            {{ payout.position }}
                        </td>
                        <td>
                            <span
                                v-if="payout.player?.name"
                                style="white-space: nowrap"
                                >{{ payout.player?.name }}
                            </span>
                            <span v-else>N/A</span>
                        </td>
                        <td class="text-center hide-on-mobile">
                            <span v-if="payout.player?.country">
                                <CountryFlag
                                    :title="payout.player?.country"
                                    :iso="payout.player?.flag"
                                />
                            </span>
                            <span v-else>-</span>
                        </td>
                        <td class="text-right">
                            <span v-html="currency"></span>
                            {{ Number(payout.prize).toLocaleString() }}
                        </td>
                    </tr>
                </template>
            </CustomeTable>
        </div>
        <div v-else>
            <h4>There are no payouts at the moment.</h4>
        </div>
    </div>
</template>

<script setup>
import CountryFlag from "vue3-country-flag-icon";

import CustomeTable from "../CustomeTable.vue";

const props = defineProps({
    payouts: {
        type: Object,
    },
    currency: {
        type: String,
    },
});
</script>

<style scoped>
.margin-top {
    margin-top: 20px;
}
</style>
