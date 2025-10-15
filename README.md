# CineBites
A seat-side concessions ordering system for pop-up cinemas and entertainment venues.

*"We have such snacks to show you."*

## Project Structure
```
cinebites/
├── apps/
│   ├── api/               # Laravel API backend
│   └── customer/          # React SPA customer frontend
│   └── admin/             # React SPA admin dashboard
├── packages/              # Shared packages
│   ├── ui/                # Shared UI components (future)
│   └── config/            # Shared configs (ESLint, Tailwind, etc.)
├── package.json           # Root package.json (Turborepo workspace)
├── turbo.json             # Turborepo build pipeline config
├── .env.example           # Root environment variables
└── README.md              # Project documentation
```

## API (Laravel)
The backend service will handle all business logic and data management:

- **Authentication System**: Passcode-based event access without user registration
- **Event Management**: Create and control individual pop-up cinema sessions
- **Menu & Inventory**: Dynamic concessions catalog with real-time stock tracking
- **Order Management**: Process orders from creation to fulfillment
- **Real-time Broadcasting**: WebSocket integration for live order updates
- **Admin Interface**: Dashboard for venue operators and staff

## Customer (React)
The customer-facing application will provide ordering functionality:

- **Event Access Portal**: Passcode entry to access active cinema sessions
- **Interactive Menu**: Browse available concessions with pricing and descriptions
- **Cart & Checkout**: Manage order items and quantities before submission
- **Seat Selection**: Choose delivery location within the venue
- **Order Tracking**: Real-time status updates from kitchen to seat
- **Mobile-Responsive**: Optimized for smartphone ordering in dark venues

## Admin (React)
The staff-facing application for managing operations and orders:

- **Live Order Dashboard**: Real-time order queue with status management
- **Kitchen Interface**: Touch-friendly order preparation workflow
- **Event Management**: Create events, manage passcodes, control active sessions
- **Inventory Control**: Stock tracking, low-stock alerts, item management
- **Analytics Dashboard**: Sales metrics, popular items, seat distribution
- **Staff Tools**: Order status updates, delivery tracking, customer communication

*"It is not hands that summon us, but hunger."*