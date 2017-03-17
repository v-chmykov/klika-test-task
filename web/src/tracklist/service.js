import api from './factory.js';

class TracklistService {
  constructor() {
    this.songs = [];
  }
  
  get fields() {
    return api.fields();
  }

  fetchData(http) {
    return api.songs(http);
  }

  setSongs(songs) {
    this.songs = songs;
  }

  get artists() {
    return this.songs.map(function (song) {
      return song.artist;
    }).sort();
  }
  
  get genres() {
    return this.songs
      .map(function (song) {
        return song.genre;
      })
      .filter(this._unique)
      .sort();
  }

  get years() {
    return this.songs
      .map(function (song) {
        return song.year;
      })
      .filter(this._unique)
      .sort(this._reverseSort);
  }

  _reverseSort(a, b) {
    return (b - a);
  }
  
  _unique(value, index, self) { 
    return self.indexOf(value) === index;
  }
}

export {TracklistService}