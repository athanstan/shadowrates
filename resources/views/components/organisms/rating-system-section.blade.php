<!-- Rating system section -->
<section class="relative z-10 py-10 bg-gradient-to-b from-transparent to-purple-900/10">
    <div class="container px-4 mx-auto">
        <div class="mb-8 text-center">
            <x-atoms.section-title>RATE YOUR CARDS</x-atoms.section-title>
            <p class="max-w-2xl mx-auto mt-4 text-purple-200">Contribute to our community database by rating cards
                you've played with. Help other players discover the best strategies!</p>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="lg:col-span-1">
                <x-atoms.neo-brutal-panel>
                    <h3 class="mb-4 text-xl font-bold text-center text-purple-200">How Rating Works</h3>

                    <div class="space-y-4">
                        <x-atoms.step-indicator number="1" title="Select a Card"
                            description="Search for any card in the Shadowverse database you want to rate." />

                        <x-atoms.step-indicator number="2" title="Rate 1-5 Stars"
                            description="Provide your rating based on the card's power level, flexibility, and impact in the current meta." />

                        <x-atoms.step-indicator number="3" title="Add Your Review"
                            description="Share your thoughts and experiences with the card to help other players." />

                        <x-atoms.step-indicator number="4" title="Help The Community"
                            description="Your ratings contribute to the overall score that helps others discover top cards." />
                    </div>
                </x-atoms.neo-brutal-panel>
            </div>

            <div class="lg:col-span-2">
                <x-atoms.neo-brutal-panel>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-purple-200">Recently Rated</h3>

                        <div class="flex space-x-3">
                            <x-atoms.cyber-tab :active="true">All Classes</x-atoms.cyber-tab>
                            <x-atoms.cyber-tab>Legendary</x-atoms.cyber-tab>
                            <x-atoms.cyber-tab>Popular</x-atoms.cyber-tab>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Rating item 1 -->
                        <x-molecules.rating-item cardName="Cosmic Dragon" cardType="Dragoncraft" cardRarity="Legendary"
                            :rating="4.9" :voteCount="328" />

                        <!-- Rating item 2 -->
                        <x-molecules.rating-item cardName="Shadow Reaper" cardType="Shadowcraft" cardRarity="Gold"
                            :rating="4.3" :voteCount="276" />

                        <!-- Rating item 3 -->
                        <x-molecules.rating-item cardName="Arcane Missile" cardType="Runecraft" cardRarity="Silver"
                            :rating="3.2" :voteCount="195" />

                        <!-- Rating item 4 -->
                        <x-molecules.rating-item cardName="Ethereal Guardian" cardType="Havencraft" cardRarity="Gold"
                            :rating="4.1" :voteCount="247" />
                    </div>

                    <div class="mt-6 text-center">
                        <a href="#" class="text-sm text-purple-300 hover:text-white">View All Ratings →</a>
                    </div>
                </x-atoms.neo-brutal-panel>
            </div>
        </div>
    </div>
</section>
