---
sidebar_position: 1
---

# go语言学习记录



ffmpeg -i $ID.mp4 -vn -ab 128k -ar 16000 -y $ID.mp3

-ac: channel 设置通道3, 默认为1

-ar: sample rate 设置音频采样率

-acodec: 使用codec编解码

-ab: bitrate 设置音频码率



ffmpeg -i 1.amr -ab 128k -ar 16000 1.mp3
