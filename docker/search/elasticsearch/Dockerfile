FROM docker.elastic.co/elasticsearch/elasticsearch:7.5.2
ENV  node.name=es01 \
     cluster.name=es-docker-cluster \
     discovery.seed_hosts=es02,es03 \
     cluster.initial_master_nodes=es01,es02,es03 \
     bootstrap.memory_lock=true \
     "ES_JAVA_OPTS=-Xms512m -Xmx512m" \
     discovery.type=single-node