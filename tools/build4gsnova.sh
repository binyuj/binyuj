#!/usr/bin/env bash
## ./bu.sh 编译gsnova
## ./bu.sh gsnova package 制作发布包

VERSION="0.22.1"

echo "$PWD"
GSNOVA_DIR=$PWD

build_product(){
    export GOPATH="$GSNOVA_DIR"
    go get -u github.com/yinqiwen/godns
    go install -v ...
}

build_package(){
    OS="`go env GOOS`"
    ARCH="`go env GOARCH`"
    DIST_DIR="$1"-"$VERSION"
    exename="$1"

    mkdir -p $GSNOVA_DIR/$DIST_DIR/cert
    mkdir -p $GSNOVA_DIR/$DIST_DIR/spac
    mkdir -p $GSNOVA_DIR/$DIST_DIR/hosts
    cp $GSNOVA_DIR/bin/main $GSNOVA_DIR/$DIST_DIR/$exename
    cp $GSNOVA_DIR/conf/"$1".conf $GSNOVA_DIR/$DIST_DIR
    cp $GSNOVA_DIR/conf/*_hosts.conf $GSNOVA_DIR/$DIST_DIR/hosts
    cp $GSNOVA_DIR/conf/Fake* $GSNOVA_DIR/$DIST_DIR/cert
    cp $GSNOVA_DIR/conf/*_spac.json $GSNOVA_DIR/$DIST_DIR/spac
    cp $GSNOVA_DIR/conf/user-gfwlist.txt $GSNOVA_DIR/$DIST_DIR/spac
    cp -r $GSNOVA_DIR/web $GSNOVA_DIR/$DIST_DIR
    chmod 744 $DIST_DIR/$exename
    tar czf ${1}_${VERSION}_${OS}_${ARCH}.tar.gz ${1}-${VERSION}
    rm -rf $GSNOVA_DIR/$DIST_DIR
}

build_product
if [ "$2" = "package" ]; then
    build_package $*
fi
