import Index from './components/Index';

import ScannerIndex from './components/scanner/ScannerIndex';

import ReportIndex from './components/reports/ReportIndex';
import ReportTable from './components/reports/ReportTable';

export const  routes = [
    {
        path: '/site-officer',
        component: Index,
        children: [
            {
                path: '',
                component: ScannerIndex
            },
            {
                path: 'reports',
                component: ReportIndex,
                children: [
                    {
                        path: '',
                        component: ReportTable
                    }
                ]
            }
        ]
    }
];
