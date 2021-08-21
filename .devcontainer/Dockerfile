ARG VARIANT=7.4
FROM mcr.microsoft.com/vscode/devcontainers/php:dev-${VARIANT}

# Install MariaDB client
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
   && apt-get install -y mariadb-client \ 
   && apt-get clean -y && rm -rf /var/lib/apt/lists/*

ARG USER_UID=1000
ARG USER_GID=$USER_UID
RUN if [ "$USER_GID" != "1000" ] || [ "$USER_UID" != "1000" ]; then \
        groupmod --gid $USER_GID vscode \
        && usermod --uid $USER_UID --gid $USER_GID vscode \
        && chown -R $USER_UID:$USER_GID /home/vscode \
        && chown -R $USER_UID:root /usr/local/share/nvm; \
    fi

ARG INSTALL_NODE="true"
ARG NODE_VERSION="lts/*"
RUN if [ "${INSTALL_NODE}" = "true" ]; then su vscode -c "source /usr/local/share/nvm/nvm.sh && nvm install ${NODE_VERSION} 2>&1"; fi

# [Optional] Uncomment this section to install additional OS packages.
# RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
#     && apt-get -y install --no-install-recommends <your-package-list-here>

# [Optional] Uncomment this line to install global node packages.
# RUN su vscode -c "source /usr/local/share/nvm/nvm.sh && npm install -g <your-package-here>" 2>&1
