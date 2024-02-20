import numpy as np
import tensorflow as tf
import keras
from keras import layers
import tensorflow_datasets as tfds
import tensorflow_recommenders as tfrs

#Global HyperParamaters
EMBEDDING_DIM=16
LEARNING_RATE=0.5
BATCH_SIZE=4096
NUM_EPOCHS=10

#Movie Recommender Model
class MovieRecommender(tfrs.Model):
	def __init__(self, user_matrix, movie_matrix, user_vect, movie_vect, task):
		super().__init__()
		self.user_matrix = user_matrix
		self.movie_matrix = movie_matrix
		self.user_vect = user_vect
		self.movie_vect = movie_vect
		self.task = task

	def compute_loss(self, ratings, training=False):
		user = ratings["user_id"]
		movie = ratings["movie_title"]
		
		user_token = self.user_vect(user) #What index is the row of the user in the user matrix
		movie_token = self.movie_vect(movie) #What index is the column of the movie in the movie matrix

		user_embeddings = self.user_matrix(user_token) #Get the matrix row of user
		movie_embeddings = self.movie_matrix(movie_token) #Get matrix column of movie
		return self.task(user_embeddings, movie_embeddings) #Calculate dot product

#The format of this recommender model was inspired by the tensorflow_recommenders tutorial 

ratings = tfds.load('movielens/100k-ratings', split="train")
movies = tfds.load('movielens/100k-movies', split="train")

ratings = ratings.map(lambda x: {
	"movie_title": x["movie_title"],
	"user_id": x["user_id"],
})
movies = movies.map(lambda x: x["movie_title"])
user_ids = ratings.map(lambda x: x["user_id"])

unique_users = np.unique(list(user_ids.as_numpy_iterator()))
unique_movies = np.unique(list(movies.as_numpy_iterator()))

users_vectorizer = layers.TextVectorization(max_tokens=len(unique_users), output_mode='int', split=None)
movies_vectorizer = layers.TextVectorization(max_tokens=len(unique_movies), output_mode='int', split=None)

users_vectorizer.adapt(unique_users)
movies_vectorizer.adapt(unique_movies)

users_vocab = users_vectorizer.get_vocabulary()
movies_vocab = movies_vectorizer.get_vocabulary()

user_matrix = keras.Sequential([
	layers.Embedding(input_dim=len(users_vocab), output_dim=EMBEDDING_DIM)
])

movie_matrix = keras.Sequential([
	layers.Embedding(input_dim=len(movies_vocab), output_dim=EMBEDDING_DIM)
])

retrievalTask = tfrs.tasks.Retrieval()

#Define the Model
model = MovieRecommender(user_matrix, movie_matrix, users_vectorizer, movies_vectorizer, retrievalTask)
optimizer = keras.optimizers.Adagrad(learning_rate=LEARNING_RATE)
model.compile(optimizer=optimizer)

#Train the model
ratingsCache = ratings.batch(BATCH_SIZE).cache()
model.fit(ratingsCache, epochs=NUM_EPOCHS)


