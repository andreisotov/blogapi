# api.ansotov.com
API for ansotov.com
This service is a blog API, it`s parse data from YouTube API and save in the service database.
<br>
The service have API endpoints.<br>
You can get articles, categories, tags and pivot data (many to many) of these databases.

# Commands
Fetch youtube channel playlists:
**php bin/console app:fetch-youtube-playlists <<your-channel-id>>**

Fetch youtube channel videos:
**php bin/console app:fetch-youtube-videos <<your-channel-id>>**
