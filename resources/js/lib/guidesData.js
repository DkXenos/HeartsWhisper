

export const guidesData = [
    {
        id: 1,
        title: "Understanding Healthy Relationships",
        description: "Learn the foundations of what makes a relationship healthy and fulfilling.",
        image: "/asset/homepage/mainbg.svg",
        videoUrl: "https://www.youtube.com/watch?v=example1",
        category: "Relationships"
    },
    {
        id: 2,
        title: "Recognizing Red Flags",
        description: "Identify warning signs early to protect your emotional wellbeing.",
        image: "/asset/homepage/mainbg.svg",
        videoUrl: "https://www.youtube.com/watch?v=example2",
        category: "Self-Protection"
    },
    {
        id: 3,
        title: "Setting Boundaries",
        description: "Discover how to establish and maintain healthy boundaries in relationships.",
        image: "/asset/homepage/mainbg.svg",
        videoUrl: "https://www.youtube.com/watch?v=example3",
        category: "Personal Growth"
    },
    {
        id: 4,
        title: "Building Self-Worth",
        description: "Strengthen your sense of self and understand your inherent value.",
        image: "/asset/homepage/mainbg.svg",
        videoUrl: "https://www.youtube.com/watch?v=example4",
        category: "Self-Love"
    },
    {
        id: 5,
        title: "Effective Communication",
        description: "Master the art of expressing yourself clearly and listening actively.",
        image: "/asset/homepage/mainbg.svg",
        videoUrl: "https://www.youtube.com/watch?v=example5",
        category: "Communication"
    },
    {
        id: 6,
        title: "Dealing with Heartbreak",
        description: "Navigate the healing process and emerge stronger after a breakup.",
        image: "/asset/homepage/mainbg.svg",
        videoUrl: "https://www.youtube.com/watch?v=example6",
        category: "Healing"
    }
];

/**
 * Get all guides
 * @returns {Array} Array of guide objects
 */
export function getAllGuides() {
    return guidesData;
}

/**
 * Get guide by ID
 * @param {number} id - Guide ID
 * @returns {Object|undefined} Guide object or undefined if not found
 */
export function getGuideById(id) {
    return guidesData.find(guide => guide.id === id);
}

/**
 * Get guides by category
 * @param {string} category - Category name
 * @returns {Array} Filtered array of guide objects
 */
export function getGuidesByCategory(category) {
    return guidesData.filter(guide => guide.category === category);
}
