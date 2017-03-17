export default {
    fields() {
        return [
            { title: 'Исполнитель', class: 'fa-sort-down' },
            { title: 'Песня', class: 'fa-sort' },
            { title: 'Жанр', class: 'fa-sort' },
            { title: 'Год', class: 'fa-sort' }
        ]
    },
    songs(http) {
        return http.get('/api/songs');
    }
}