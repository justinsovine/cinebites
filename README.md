# CineBites
*We have such snacks to show you.*

A seat-side concessions ordering system for pop-up cinemas and entertainment venues.

## Project Structure
```
cinebites/
├── api/                    # Laravel API backend
├── frontend/               # React SPA frontend
└── docker-compose.yml      # Development environment
```

## API (Laravel)
The backend service will handle all business logic and data management:

- **Authentication System**: Passcode-based event access without user registration
- **Event Management**: Create and control individual pop-up cinema sessions
- **Menu & Inventory**: Dynamic concessions catalog with real-time stock tracking
- **Order Management**: Process orders from creation to fulfillment
- **Real-time Broadcasting**: WebSocket integration for live order updates
- **Admin Interface**: Dashboard for venue operators and staff

## Frontend (React)
The customer-facing application will provide ordering functionality:

- **Event Access Portal**: Passcode entry to access active cinema sessions
- **Interactive Menu**: Browse available concessions with pricing and descriptions
- **Cart & Checkout**: Manage order items and quantities before submission
- **Seat Selection**: Choose delivery location within the venue
- **Order Tracking**: Real-time status updates from kitchen to seat ()
- **Mobile-Responsive**: Optimized for smartphone ordering in dark venues

*"It is not hands that summon us, but hunger."*