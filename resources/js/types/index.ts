export interface Book {
    id: number;
    title: string;
    description: string;
    extended_description: string;
    price: string;
    age_range: string;
    page_count: number;
    materials: string;
    dimensions: string;
    manufacturing_time: string;
    created_at: string;
    updated_at: string;
    images: BookImage[];
    videos: BookVideo[];
    categories: Category[];
}

export interface BookImage {
    id: number;
    path: string;
    book_id: number;
    created_at: string;
    updated_at: string;
}

export interface BookVideo {
    id: number;
    path: string;
    book_id: number;
    created_at: string;
    updated_at: string;
}

export interface Category {
    id: number;
    name: string;
    description: string | null;
    slug: string | null;
    created_at: string;
    updated_at: string;
}
