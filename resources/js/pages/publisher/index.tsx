interface Publisher {
    id: number;
    name: string;
    about: string;
    website_url: string;
}

interface Publishers {
    publishers: Publisher[];
}

export default function Index({ publishers }: Publishers) {
    return (
        <main className="space-y-4">
            <h1>publishers</h1>
        </main>
    );
}