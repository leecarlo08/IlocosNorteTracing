import Index from './components/Index';

import SpotIndex from './components/spots/SpotIndex';
import SpotTable from './components/spots/SpotTable';
import CreateSpot from './components/spots/CreateSpot';
import EditSpot from './components/spots/EditSpot';

import AccountIndex from './components/accounts/AccountIndex';
import AccountTable from './components/accounts/AccountTable';
import CreateAccount from './components/accounts/CreateAccount';
import EditAccount from './components/accounts/EditAccount';

import ReportIndex from './components/reports/ReportIndex';
import ReportTable from './components/reports/ReportTable';

export const  routes = [
    {
        path: '/super-user',
        component: Index,
        children: [
            {
                path: 'spot',
                component: SpotIndex,
                children: [
                    {
                        path: '',
                        component: SpotTable
                    },
                    {
                        path: 'create',
                        component: CreateSpot
                    },
                    {
                        path: ':id/edit',
                        component: EditSpot
                    }
                ]
            },
            {
                path: 'accounts',
                component: AccountIndex,
                children: [
                    {
                        path: '',
                        component: AccountTable
                    },
                    {
                        path: 'create',
                        component: CreateAccount
                    },
                    {
                        path: ':id/edit',
                        component: EditAccount
                    }
                ]
            },
            {
                path: 'reports'
            }
        ]
    }
];
