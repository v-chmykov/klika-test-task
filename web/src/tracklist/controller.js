class TracklistController {
  /**
   * Constructor
   */
  constructor(TracklistService, $http) {
    const self = this;
    self.http = $http;
    self.service = TracklistService;

    // filters
    self.params = {
      artist: '',
      genre: '',
      year: ''
    };

    self.updateState();
    self.pagination = [
      { cnt: 10, isActive: true },
      { cnt: 20, isActive: false },
      { cnt: 50, isActive: false }
    ];
    self.curPage = 1;
    self.itemPerPage = 10;
  }

  /**
   * Switch classes on icons
   */
  setSort(index) {
    this.fields.map((field, i) => {
      if ((i == index)) {
        switch (field.class) {
          case 'fa-sort-down':
            field.class = 'fa-sort-up';
            break;
          case 'fa-sort-up':
          default:
            field.class = 'fa-sort-down';
        }
      } else {
        field.class = 'fa-sort';
      }

      return field;
    });
  }

  /**
   * 
   */
  updateState() {
    const self = this;
    
    // main info
    self.fields = self.service.fields;
    self.service.fetchData(self.http).then(
      function successCallback(response) {
        let data = response.data;

        self.service.setSongs(data);
        self.artists = self.service.artists;
        self.genres = self.service.genres;
        self.years = self.service.years;

        self.data = data;
      },
      function rejectCallback(response) {
        alert('Server problem');
      }
    );
  }
}


TracklistController.$inject = ['TracklistService', '$http'];
export {TracklistController}