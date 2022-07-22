<template>
    <div>
        <TabGroup>
            <TabList class="flex flex-wrap -mb-px font-medium text-center border-b border-gray-200">
                <Tab v-slot="{ selected }" as="template">
                    <button
                        class="mr-2 inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        :class="{ 'border-b-4 border-blue-500' : selected }"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                        Заказы
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                       class="mr-2 inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                       :class="{ 'border-b-4 border-blue-500' : selected }"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                        Пользователи
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                        class="mr-2 inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        :class="{ 'border-b-4 border-blue-500' : selected }"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                        Аналитика
                    </button>
                </Tab>
            </TabList>
            <TabPanels class="mt-2">
                <TabPanel
                :class="[
                    'bg-gray-100 rounded-xl p-3'
                ]"
                >Test1</TabPanel>
                <TabPanel
                :class="[
                    'bg-gray-100 rounded-xl p-3'
                ]"
                >Test2</TabPanel>
                <TabPanel
                :class="[
                    'bg-gray-100 rounded-xl p-3'
                ]"
                >test3</TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>
