import Index from './components/Index';

import TouristSpotIndex from './components/TouristSpot/TouristSpotIndex';

import ScheduleIndex from './components/Schedule/ScheduleIndex';
import ScheduleTable from './components/Schedule/ScheduleTable';
import CreateSchedule from './components/Schedule/CreateSchedule';
import ViewSchedule from './components/Schedule/ViewSchedule';

import MyQr from './components/MyQR/MyQr';

export const  routes = [
    {
        path: '/profile',
        component: Index,
        children: [
            {
                path: '',
                component: TouristSpotIndex,
            },
            {
                path: 'schedule',
                component: ScheduleIndex,
                children: [
                    {
                        path: '',
                        component: ScheduleTable
                    },
                    {
                        path: 'create',
                        component: CreateSchedule
                    },
                    {
                        path: ':id/view',
                        component: ViewSchedule
                    }
                ]
            },
            {
                path: 'my-qr',
                component: MyQr
            }
        ],
    },

];
