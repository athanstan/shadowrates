<x-app-layout>
    <x-roadmap.layout>
        <x-roadmap.header />

        <x-roadmap.timeline>
            <!-- Q2 2024 Section -->
            <x-roadmap.quarter-section quarter="Q2 2024" badge="Right Now" badgeEmoji="😎" badgeColor="indigo">

                <x-roadmap.features-group>
                    <!-- Core Features -->
                    <x-roadmap.feature-card title="Core Features"
                        description="Essential functionality for the initial launch" status="completed">
                        <x-roadmap.feature-item status="completed">Card Collection Browser</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="completed">Basic Deck Builder</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="completed">Google Authentication</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="completed">User Profiles</x-roadmap.feature-item>
                    </x-roadmap.feature-card>

                    <!-- UI Enhancements -->
                    <x-roadmap.feature-card title="UI Enhancements"
                        description="Improved user experience and interface elements" status="in-progress">
                        <x-roadmap.feature-item status="completed">Responsive Design for Mobile</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="completed">Dark Mode Implementation</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="in-progress">Advanced Card Filtering</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="in-progress">Interactive Card Previews</x-roadmap.feature-item>
                    </x-roadmap.feature-card>
                </x-roadmap.features-group>

                <x-roadmap.small-features-group title="Small Improvements" columns="3">
                    <x-roadmap.small-feature title="Card Tooltips" status="completed" />
                    <x-roadmap.small-feature title="Deck Sharing URLs" status="completed" />
                    <x-roadmap.small-feature title="Export to Clipboard" status="in-progress" />
                    <x-roadmap.small-feature title="Keyboard Shortcuts" status="in-progress" />
                    <x-roadmap.small-feature title="Card Rating System" status="coming-soon" />
                    <x-roadmap.small-feature title="Deck Statistics" status="coming-soon" />
                </x-roadmap.small-features-group>
            </x-roadmap.quarter-section>

            <!-- Q3 2024 Section -->
            <x-roadmap.quarter-section quarter="Q3 2024" badge="Coming Next" badgeEmoji="✨" badgeColor="purple">

                <x-roadmap.features-group>
                    <!-- Card Wishlist -->
                    <x-roadmap.feature-card title="Card Wishlist"
                        description="Create and manage wishlists of cards you want to acquire" status="coming-soon">
                        <x-roadmap.feature-item status="coming-soon">Multiple custom wishlists</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="coming-soon">Priority tagging system</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="coming-soon">Public & private sharing
                            options</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="coming-soon">Import/export
                            functionality</x-roadmap.feature-item>
                    </x-roadmap.feature-card>

                    <!-- Social Profiles -->
                    <x-roadmap.feature-card title="Social Profiles"
                        description="Enhanced user profiles with social features" status="coming-soon">
                        <x-roadmap.feature-item status="coming-soon">Customizable user profiles</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="coming-soon">Follow other users</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="coming-soon">Activity feed</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="coming-soon">Achievement system</x-roadmap.feature-item>
                    </x-roadmap.feature-card>
                </x-roadmap.features-group>

            </x-roadmap.quarter-section>

            <!-- Q4 2024 Section -->
            <x-roadmap.quarter-section quarter="Q4 2024" badge="In the Future" badgeEmoji="🚀" badgeColor="blue">

                <x-roadmap.features-group>
                    <!-- Match History -->
                    <x-roadmap.feature-card title="Match History"
                        description="Track your match history and analyze your performance" status="planned">
                        <x-roadmap.feature-item status="planned">Win/loss tracking</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="planned">Match replay system</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="planned">Performance analytics</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="planned">Meta breakdown</x-roadmap.feature-item>
                    </x-roadmap.feature-card>

                    <!-- Tournament Creator -->
                    <x-roadmap.feature-card title="Tournament Creator"
                        description="Organize and manage your own Shadowverse tournaments" status="planned">
                        <x-roadmap.feature-item status="planned">Custom tournament formats</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="planned">Bracket management</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="planned">Tournament invitations</x-roadmap.feature-item>
                        <x-roadmap.feature-item status="planned">Results and statistics</x-roadmap.feature-item>
                    </x-roadmap.feature-card>
                </x-roadmap.features-group>
            </x-roadmap.quarter-section>
        </x-roadmap.timeline>

        <x-roadmap.feedback-section />
    </x-roadmap.layout>
</x-app-layout>
