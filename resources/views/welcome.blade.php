<x-app-layout>
    <!-- All the custom welcome page content goes here -->

    <!-- Hero Section -->
    <x-organisms.hero-section />

    <!-- Features Section -->
    <x-organisms.features-section />

    <!-- Rating system section -->
    <x-organisms.rating-system-section />

    <!-- Trending Cards section -->
    <x-molecules.section-container title="TRENDING CARDS"
        description="See which cards are making waves in the current meta based on our community ratings."
        titleFrom="purple-400" titleVia="blue-500" titleTo="purple-400" bgGradient="from-purple-900/10 to-transparent">

        <!-- Trending cards content continues... -->
        <!-- Keep all the trending cards content here -->
    </x-molecules.section-container>

    <!-- Community section -->
    <x-molecules.section-container title="JOIN THE COMMUNITY"
        description="Connect with thousands of Shadowverse players around the world. Share strategies, rate cards, and climb the ranking together!"
        titleFrom="indigo-400" titleVia="purple-500" titleTo="indigo-400" padding="py-20">

        <!-- Community section content continues... -->
        <!-- Keep all the community section content here -->
    </x-molecules.section-container>

    <!-- CTA section -->
    <x-organisms.cta-section title="Ready to elevate your Shadowverse experience?"
        description="Join thousands of players using ShadowRates to track cards, build decks, and improve their game."
        buttonText="Explore Cards" buttonLink="{{ route('cards.index') }}" :buttonWireNavigate="true" />
</x-app-layout>
