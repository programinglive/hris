interface Section {
    [key: string]: string[];
}

interface DocMapping {
    'Introduction': 'getting-started.md';
    'Installation': 'installation.md';
    'Installation Wizard': 'installation-wizard.md';
    'API Documentation': 'api.md';
    'Employee Management': 'employee.md';
    'Organization Structure': 'organization.md';
    'README': 'README.md';
}

type DocTitle = keyof DocMapping;

export const sections: Section = {
    'Getting Started': [
        'Introduction',
        'Installation',
        'Installation Wizard'
    ] as DocTitle[],
    'Features': [
        'Employee Management',
        'Organization Structure'
    ] as DocTitle[],
    'API': [
        'API Documentation'
    ] as DocTitle[],
    'Reference': [
        'README'
    ] as DocTitle[]
};

export const docs: DocMapping = {
    'Introduction': 'getting-started.md',
    'Installation': 'installation.md',
    'Installation Wizard': 'installation-wizard.md',
    'API Documentation': 'api.md',
    'Employee Management': 'employee.md',
    'Organization Structure': 'organization.md',
    'README': 'README.md'
};
